package net.advancius.cat2mc;

import com.github.stefvanschie.inventoryframework.gui.GuiItem;
import com.github.stefvanschie.inventoryframework.gui.type.ChestGui;
import com.github.stefvanschie.inventoryframework.pane.OutlinePane;
import net.minecraft.server.v1_16_R3.WorldServer;
import org.bukkit.Bukkit;
import org.bukkit.ChatColor;
import org.bukkit.Location;
import org.bukkit.command.Command;
import org.bukkit.command.CommandExecutor;
import org.bukkit.command.CommandSender;
import org.bukkit.craftbukkit.v1_16_R3.CraftWorld;
import org.bukkit.craftbukkit.v1_16_R3.entity.CraftPlayer;
import org.bukkit.entity.HumanEntity;
import org.bukkit.entity.Player;
import org.bukkit.inventory.ItemStack;
import org.bukkit.inventory.meta.ItemMeta;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

public class MenuCommand implements CommandExecutor {

    Cat2mc plugin = Cat2mc.getPlugin(Cat2mc.class);

    // This method is called, when somebody uses our command
    @Override
    public boolean onCommand(CommandSender sender, Command cmd, String label, String[] args) {
        if (!(sender instanceof Player)) {
            return false;
        }

        Player player = (Player) sender;

        ChestGui gui = new ChestGui(2, ChatColor.DARK_AQUA + ""+ ChatColor.BOLD +"Your Cats");

        gui.setOnGlobalClick(event -> event.setCancelled(true));

        ArrayList<PlayerCat> cats = getCats(player);

        OutlinePane navigationPane = new OutlinePane(0, 0, 9, 2);

        for (PlayerCat cat : cats) {
            AddCatToGUI(cat,navigationPane);
        }

        gui.addPane(navigationPane);

        gui.show(player);

        // If the player (or console) uses our command correct, we can return true
        return true;
    }

    private void AddCatToGUI(PlayerCat cat, OutlinePane navigationPane) {
        ItemStack shop = new ItemStack(cat.getMenuItem());
        ItemMeta shopMeta = shop.getItemMeta();
        shopMeta.setDisplayName(ChatColor.GREEN + cat.name);
        List<String> lore = new ArrayList<String>(); //create a List<String> for the lore
        lore.add(" ");
        lore.add(ChatColor.GRAY + cat.breed);
        shopMeta.setLore(lore);
        shop.setItemMeta(shopMeta);

        navigationPane.addItem(new GuiItem(shop, event -> {
            //navigate to the shop
            HumanEntity player = event.getWhoClicked();
            player.sendMessage("SPAWNING CAT...");
            Location loc = player.getLocation();
            CraftPlayer craftPlayer = ((CraftPlayer) player);

            CustomCat customCat = new CustomCat(player,cat.getBreed(), cat.name, cat.color, cat.baby, loc);
            WorldServer world = ((CraftWorld) player.getWorld()).getHandle(); // Creates and NMS world
            world.addEntity(customCat); // Adds the entity to the world

        }));
    }

    public ArrayList<PlayerCat> getCats(Player player) {

        ArrayList<PlayerCat> cats = new ArrayList<>();

        String uuid_string = player.getUniqueId().toString().replaceAll("-", "");
        try {
            PreparedStatement statement = plugin.getConnection()
                    .prepareStatement("SELECT * FROM " + plugin.table + " WHERE owner_uuid=?");
            statement.setString(1, uuid_string);
            ResultSet results = statement.executeQuery();

            while (results.next()) {
                //player.sendMessage(results.getString("owner_uuid"));
                //player.sendMessage(uuid_string);
                String breed = results.getString("breed");
                String name = results.getString("cat_name");
                boolean baby = results.getBoolean("baby");
                String color = results.getString("color");
                PlayerCat cat = new PlayerCat(breed,name,baby,color);
                cats.add(cat);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return cats;
    }

}
