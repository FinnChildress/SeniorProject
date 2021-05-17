package net.advancius.cat2mc;

import net.advancius.cat2mc.catbreeds.CatBreed;
import net.minecraft.server.v1_16_R3.*;
import org.bukkit.*;
import org.bukkit.Material;
import org.bukkit.Particle;
import org.bukkit.attribute.Attribute;
import org.bukkit.craftbukkit.v1_16_R3.CraftWorld;
import org.bukkit.entity.HumanEntity;
import org.bukkit.entity.Player;
import org.bukkit.scheduler.BukkitRunnable;
import org.bukkit.scheduler.BukkitTask;

import java.lang.reflect.Field;
import java.util.HashMap;
import java.util.Map;
import java.util.SplittableRandom;

public class CustomCat extends EntityCat {
    private static Field attributeField;
    Cat2mc plugin = Cat2mc.getPlugin(Cat2mc.class);
    protected CustomCat thisCat = this;
    public boolean wantsAPet = false;
    public boolean isAgro = false;
    public String name = "";
    private int shedChance = 20;
    private int vocalChance = 20;
    private int hairballChance = 20;
    public int attackChance = 50;
    public int petChance = 8;
    private SplittableRandom random = new SplittableRandom();
    public CatBreed catBreed;

    //Constructor
    public CustomCat(HumanEntity owner, CatBreed catBreed, String name, String color, boolean baby, Location loc) {
        super(EntityTypes.CAT, ((CraftWorld) loc.getWorld()).getHandle()); // Super the EntityPig Class
        this.setPosition(loc.getX(), loc.getY(), loc.getZ()); // Sets the location of the CustomPig when we spawn it
        this.setCatType(getCatTypeInt(color));
        this.setHealth(catBreed.getHealth()*4); // Sets Health
        this.setBaby(baby);
        this.setCustomName(new ChatComponentText(org.bukkit.ChatColor.LIGHT_PURPLE + owner.getName() + "'s "+ name)); // Sets custom name.
        this.setCustomNameVisible(true); // Makes the name visible to the player in-game
        this.setOwnerUUID(owner.getUniqueId());
        this.catBreed = catBreed;
        this.name = name;
        this.shedChance = (int)(catBreed.getShedding()*4);
        this.hairballChance = (int)(catBreed.getShedding());
        this.vocalChance = (int)(catBreed.getVocalization()*4);
        this.attackChance = (int)(catBreed.getAggression()*10);
        this.petChance = (int)(catBreed.getAffection()*1.6);

        try {
            registerGenericAttribute(this.getBukkitEntity(), Attribute.GENERIC_ATTACK_DAMAGE);
            registerGenericAttribute(this.getBukkitEntity(), Attribute.GENERIC_FOLLOW_RANGE);
        } catch (IllegalAccessException e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        }
    }

    BukkitTask task = new BukkitRunnable() {
        @Override
        public void run() {
            if (thisCat.getBukkitEntity().isDead()) {
                this.cancel();
            }
            Location loc = thisCat.getBukkitEntity().getLocation();

            if (thisCat.random.nextInt(0,1000) < thisCat.shedChance) {
                org.bukkit.inventory.ItemStack bukkitItem = new org.bukkit.inventory.ItemStack(Material.STRING);
                bukkitItem.getItemMeta().setDisplayName("Cat Shedding");
                thisCat.getBukkitEntity().getWorld().dropItemNaturally(loc, bukkitItem); // drops a lever at his location..
            }

            if (thisCat.random.nextInt(0,1000) < thisCat.vocalChance) {
                for(Player p : Bukkit.getOnlinePlayers()) {
                    if (thisCat.isAgro) {
                        p.playSound(loc, Sound.ENTITY_CAT_HISS, 1, 1);
                    }
                    else {
                        p.playSound(loc, Sound.ENTITY_CAT_AMBIENT, 1, 1);
                    }
                }
            }

            if (thisCat.random.nextInt(0,1000) < thisCat.hairballChance) {
                org.bukkit.inventory.ItemStack bukkitItem = new org.bukkit.inventory.ItemStack(Material.DEAD_BUBBLE_CORAL_FAN);
                bukkitItem.getItemMeta().setDisplayName("Cat Hairball");
                thisCat.getBukkitEntity().getWorld().dropItemNaturally(loc, bukkitItem); // drops a lever at his location..
                int i = 0;
                while (i < 10) {
                    thisCat.getBukkitEntity().getWorld().spawnParticle(Particle.SPIT, loc, 2);
                    i++;
                }
                for(Player p : Bukkit.getOnlinePlayers()) {
                    p.playSound(loc, Sound.ENTITY_CAT_HURT, 1, 1);
                }
            }

            if (thisCat.wantsAPet) {
                for(Player p : Bukkit.getOnlinePlayers()) {
                    p.playSound(loc, Sound.ENTITY_CAT_PURREOW, 1, 1);
                }
            }
        }
    }.runTaskTimer(plugin, 0L, 20);


    @Override
    public void initPathfinder() { // This method will apply some custom pathfinders to our pig
        float petDistance = 2.0f;
        float followDistance = 5.0f;

        // These are the two attributes we need. We can actually add any attribute we want like this.
        //  current attributes            add an attribute       the attribute to add            |lambda|        attribute value(acts very weird)
        this.getAttributeMap().b().add(new AttributeModifiable(GenericAttributes.ATTACK_DAMAGE, (a) -> {a.setValue(0.01);}));
        this.getAttributeMap().b().add(new AttributeModifiable(GenericAttributes.FOLLOW_RANGE, (a) -> {a.setValue(1.0);}));
        // Adds attack goal to pig
        this.goalSelector.a(1, new PathfinderGoalCustomMeleeAttack(this, 1.0D, false));

        this.goalSelector.a(0,new PathfinderGoalFollowOwner(this, 1.0, followDistance, followDistance, true));
        this.goalSelector.a(2,new PathfinderGoalWantsAPet(this, 1.0, petDistance, petDistance, true));
        //this.goalSelector.a(0, new PathfinderGoalPet(this, 1, 15));
        this.targetSelector.a(1, new PathfinderGoalNearestAttackableTarget<EntityCat>(this, EntityCat.class, true));
        this.goalSelector.a(0, new PathfinderGoalFloat(this));
        this.goalSelector.a(2, new PathfinderGoalLookAtPlayer(this, EntityHuman.class, 8.0F));
    }

    //Credit to @ysl3000
    //We need this to register the new attribute to the pig
    static {
        try {
            attributeField = net.minecraft.server.v1_16_R3.AttributeMapBase.class.getDeclaredField("b");
            attributeField.setAccessible(true);
        } catch (NoSuchFieldException e) {
            e.printStackTrace();
        }
    }

    public void registerGenericAttribute(org.bukkit.entity.Entity entity, Attribute attribute) throws IllegalAccessException {
        net.minecraft.server.v1_16_R3.AttributeMapBase attributeMapBase = ((org.bukkit.craftbukkit.v1_16_R3.entity.CraftLivingEntity)entity).getHandle().getAttributeMap();
        Map<AttributeBase, AttributeModifiable> map = (Map<net.minecraft.server.v1_16_R3.AttributeBase, net.minecraft.server.v1_16_R3.AttributeModifiable>) attributeField.get(attributeMapBase);
        net.minecraft.server.v1_16_R3.AttributeBase attributeBase = org.bukkit.craftbukkit.v1_16_R3.attribute.CraftAttributeMap.toMinecraft(attribute);
        net.minecraft.server.v1_16_R3.AttributeModifiable attributeModifiable = new net.minecraft.server.v1_16_R3.AttributeModifiable(attributeBase, net.minecraft.server.v1_16_R3.AttributeModifiable::getAttribute);
        map.put(attributeBase, attributeModifiable);
    }


    private HashMap<String, Integer> catTypeMap = new HashMap<String, Integer>() {{
        put("TABBY",0);
        put("TUXEDO",1);
        put("RED",2);
        put("SIAMESE",3);
        put("GREY",4);
        put("CALICO",5);
        put("PERSIAN",6);
        put("RAGDOLL",7);
        put("WHITE",8);
        put("JELLIE",9);
        put("BLACK",10);

    }};

    private int getCatTypeInt(String typeName) {
        return catTypeMap.get(typeName.toUpperCase());
    }
}
