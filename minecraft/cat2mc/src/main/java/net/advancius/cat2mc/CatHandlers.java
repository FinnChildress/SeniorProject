package net.advancius.cat2mc;

import net.minecraft.server.v1_16_R3.EntityCat;
import org.bukkit.Bukkit;
import org.bukkit.Location;
import org.bukkit.Particle;
import org.bukkit.Sound;
import org.bukkit.craftbukkit.v1_16_R3.entity.CraftCat;
import org.bukkit.entity.Cat;
import org.bukkit.entity.Entity;
import org.bukkit.entity.Player;
import org.bukkit.event.EventHandler;
import org.bukkit.event.Listener;
import org.bukkit.event.entity.EntityDamageByEntityEvent;
import org.bukkit.event.player.PlayerInteractEntityEvent;

public class CatHandlers implements Listener {

    @EventHandler
    public void onDamage(EntityDamageByEntityEvent event) {
        Entity attacker = event.getDamager();
        Entity victim = event.getEntity();

        //Bukkit.getLogger().info("SDF1");

        if (attacker instanceof Cat) {
            EntityCat eCatAtt = ((CraftCat)attacker).getHandle();
            if (eCatAtt instanceof CustomCat) {
                if (victim instanceof Cat) {
                    EntityCat eCatVic = ((CraftCat) victim).getHandle();
                    if (eCatVic instanceof CustomCat) {
                        event.setDamage(0.0001);
                    }
                }
            }
        }
    }


    @EventHandler
    public void onPlayerInteractEntity (PlayerInteractEntityEvent event) {
        Entity entity = event.getRightClicked();
        Player player = event.getPlayer();

        //Bukkit.getLogger().info("SDF1");

        if (entity instanceof Cat) {
            EntityCat eCat = ((CraftCat)entity).getHandle();
            if (eCat instanceof CustomCat) {
                CustomCat cat = (CustomCat)eCat;

                Bukkit.getLogger().info("SDF2");
                if (cat.wantsAPet && cat.getOwnerUUID().equals(player.getUniqueId())) {
                    cat.wantsAPet = false;
                    petCat(cat,entity,player);
                    event.setCancelled(true);
                }
                else if (cat.isAgro && cat.getOwnerUUID().equals(player.getUniqueId())) {
                    cat.isAgro = false;
                    petCat(cat,entity,player);
                    event.setCancelled(true);
                }

            }

        }
    }

    private void petCat (CustomCat cat, Entity entity, Player player) {
        int i = 0;
        while (i < 10) {
            entity.getWorld().spawnParticle(Particle.HEART, entity.getLocation(), 10);
            i++;
        }
        Bukkit.getLogger().info("SDF3");
        player.sendMessage("You petted "+cat.name);
        for(Player p : Bukkit.getOnlinePlayers()) {
            p.playSound(entity.getLocation(), Sound.ENTITY_CAT_PURR, 1, 1);
        }
    }
}
