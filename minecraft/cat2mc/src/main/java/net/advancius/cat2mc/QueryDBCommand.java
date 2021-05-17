package net.advancius.cat2mc;

import org.bukkit.command.Command;
import org.bukkit.command.CommandExecutor;
import org.bukkit.command.CommandSender;
import org.bukkit.entity.Player;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.UUID;

public class QueryDBCommand implements CommandExecutor {

    Cat2mc plugin = Cat2mc.getPlugin(Cat2mc.class);

    // This method is called, when somebody uses our command
    @Override
    public boolean onCommand(CommandSender sender, Command cmd, String label, String[] args) {
        if (!(sender instanceof Player)) {
            return false;
        }

        Player player = (Player) sender;

        getCats(player);
        return true;
    }

    public void getCats(Player player) {

        String uuid_string = player.getUniqueId().toString().replaceAll("-", "");
        try {
            PreparedStatement statement = plugin.getConnection()
                    .prepareStatement("SELECT * FROM " + plugin.table + " WHERE owner_uuid=?");
            statement.setString(1, uuid_string);
            ResultSet results = statement.executeQuery();

            String message = "";

            while (results.next()) {
                //player.sendMessage(results.getString("owner_uuid"));
                //player.sendMessage(uuid_string);

                message += ("Cat name: "+results.getString("cat_name"));
                message += (" breed: "+results.getString("breed"));
                message += (" baby: "+results.getString("baby"));
                message += (" color: "+results.getString("color"));
                message += " \n";
            }
            player.sendMessage(message);
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

}
