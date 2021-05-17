package net.advancius.cat2mc;


import java.util.EnumSet;
import java.util.SplittableRandom;

import net.minecraft.server.v1_16_R3.*;
import net.minecraft.server.v1_16_R3.PathfinderGoal.Type;
import org.bukkit.Bukkit;
import org.bukkit.Particle;
import org.bukkit.Sound;
import org.bukkit.craftbukkit.v1_16_R3.entity.CraftEntity;
import org.bukkit.entity.Player;

public class PathfinderGoalCustomMeleeAttack extends PathfinderGoal {
    protected final EntityCreature a;
    private final double b;
    private final boolean c;
    private PathEntity d;
    private double e;
    private double f;
    private double g;
    private int h;
    private int i;
    private final int j = 20;
    private long k;

    private SplittableRandom random = new SplittableRandom();

    public PathfinderGoalCustomMeleeAttack(EntityCreature var0, double var1, boolean var3) {
        this.a = var0;
        this.b = var1;
        this.c = var3;
        this.a(EnumSet.of(Type.MOVE, Type.LOOK));
    }

    public boolean a() {
        long var0 = this.a.world.getTime();
        if (var0 - this.k < 20L) {
            return false;
        } else {
            this.k = var0;
            EntityLiving var2 = this.a.getGoalTarget();
            if (var2 == null) {
                return false;
            } else if (!var2.isAlive()) {
                return false;
            } else if (((CustomCat)a).isAgro == false && random.nextInt(0,1000) > ((CustomCat)a).attackChance) {
                return false;
            } else {
                CustomCat cat = ((CustomCat)a);

                if (cat.isAgro == false) {
                    cat.isAgro = true;
                    CraftEntity catEntity = cat.getBukkitEntity();

                    for(Player p : Bukkit.getOnlinePlayers()) {
                        p.playSound(catEntity.getLocation(), Sound.ENTITY_CAT_HISS, 1, 1);
                    }

                    int i = 0;
                    while (i < 10) {
                        catEntity.getWorld().spawnParticle(Particle.VILLAGER_ANGRY, catEntity.getLocation(), 10);
                        i++;
                    }
                }


                this.d = this.a.getNavigation().a(var2, 0);
                if (this.d != null) {
                    return true;
                } else {
                    return this.a(var2) >= this.a.h(var2.locX(), var2.locY(), var2.locZ());
                }
            }
        }
    }

    public boolean b() {
        EntityLiving var0 = this.a.getGoalTarget();
        if (var0 == null) {
            return false;
        } else if (!var0.isAlive()) {
            return false;
        } else if (!this.c) {
            return !this.a.getNavigation().m();
        } else if (!this.a.a(var0.getChunkCoordinates())) {
            return false;
        } else {
            return !(var0 instanceof EntityHuman) || !var0.isSpectator() && !((EntityHuman)var0).isCreative();
        }
    }

    public void c() {
        this.a.getNavigation().a(this.d, this.b);
        this.a.setAggressive(true);
        this.h = 0;
        this.i = 0;
    }

    public void d() {
        EntityLiving var0 = this.a.getGoalTarget();
        if (!IEntitySelector.e.test(var0)) {
            this.a.setGoalTarget((EntityLiving)null);
        }

        this.a.setAggressive(false);
        this.a.getNavigation().o();
    }

    public void e() {
        EntityLiving var0 = this.a.getGoalTarget();
        this.a.getControllerLook().a(var0, 30.0F, 30.0F);
        double var1 = this.a.h(var0.locX(), var0.locY(), var0.locZ());
        this.h = Math.max(this.h - 1, 0);
        if ((this.c || this.a.getEntitySenses().a(var0)) && this.h <= 0 && (this.e == 0.0D && this.f == 0.0D && this.g == 0.0D || var0.h(this.e, this.f, this.g) >= 1.0D || this.a.getRandom().nextFloat() < 0.05F)) {
            this.e = var0.locX();
            this.f = var0.locY();
            this.g = var0.locZ();
            this.h = 4 + this.a.getRandom().nextInt(7);
            if (var1 > 1024.0D) {
                this.h += 10;
            } else if (var1 > 256.0D) {
                this.h += 5;
            }

            if (!this.a.getNavigation().a(var0, this.b)) {
                this.h += 15;
            }
        }

        this.i = Math.max(this.i - 1, 0);
        this.a(var0, var1);
    }

    protected void a(EntityLiving var0, double var1) {
        double var3 = this.a(var0);
        if (var1 <= var3 && this.i <= 0) {
            this.g();
            this.a.swingHand(EnumHand.MAIN_HAND);
            this.a.attackEntity(var0);
        }

    }

    protected void g() {
        this.i = 20;
    }

    protected boolean h() {
        return this.i <= 0;
    }

    protected int j() {
        return this.i;
    }

    protected int k() {
        return 20;
    }

    protected double a(EntityLiving var0) {
        return (double)(this.a.getWidth() * 2.0F * this.a.getWidth() * 2.0F + var0.getWidth());
    }
}
