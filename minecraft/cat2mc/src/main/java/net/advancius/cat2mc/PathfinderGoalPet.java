package net.advancius.cat2mc;

import net.minecraft.server.v1_16_R3.*;

import java.util.EnumSet;

public class PathfinderGoalPet extends PathfinderGoal {

    /*
     * If you add extends PathfinderGoal to any class it will
     * tell you to add unimplemented methods.
     * When you import them there will be a new
     * method named, a(), this method will run
     * every tick, but we also need to add our constructor, so
     * we can ask, a(), to do something.
     *
     */

    private final EntityInsentient a; // Our pet.
    private EntityLiving b; // Owner <--- player

    private final double f; // Pet's speed.
    private final double g; // Distance between the owner and pet.

    private double c; // X
    private double d; // y
    private double e; // z

    public PathfinderGoalPet(EntityInsentient a, double speed, float distance) {
        this.a = a;
        this.f = speed;
        this.g = distance;
        this.a(EnumSet.of(PathfinderGoal.Type.MOVE)); // This sets the goal type.
        //  In this case its move as we want our pet to move to the player
    }


    @Override
    public boolean a() {
        // Will start the pathfinding goal if it's true.
        // runs every tick
        this.b = this.a.getGoalTarget(); // Makes the player the pigs target.

        // Now we need to add several checks to prevent bugs.
        if (this.b == null) { // Checks if the pet is null.
            return false; // Stops the goal if the pet is null.
        } else if (this.a.getDisplayName() == null) {
            return false;
        } else if (!(this.a.getDisplayName().toString().contains(this.b.getName()))) { // Checks if the pet's name contains the owners name.
            return false;                                                              // This is how we tell the pet who to follow.

        } else if (this.b.h(this.a) > (double) (this.g * this.g)) { // Checks the pets distance from the player.
            a.setPosition(this.b.locX(), this.b.locY(), this.b.locZ()); // Teleport the pet to the player if he gets to far away.
            return false;
        } else { // Makes pet follow the player

            Vec3D vec = RandomPositionGenerator.a((EntityCreature)this.a, 16, 7, this.b.getPositionVector());
            // In air check using Vec3D
            if (vec == null) {
                return false;
            }

            this.c = this.b.locX();
            this.d = this.b.locY();
            this.e = this.b.locZ();

            return true;// <-- runs c()
        }

    }

    @Override
    public void c() { // runs when a() returns true.
        // runner                   x       y      z     speed
        this.a.getNavigation().a(this.c, this.d, this.e, this.f);

    }

    @Override
    public boolean b() {
        // runs after c()
        // runs every tick as long as its true (repeats c)
        return !this.a.getNavigation().m() && this.b.h(this.a) < (double) (this.g * this.g);
    }

    @Override
    public void d() {
        // runs when b() returns false.
        this.b = null;
    }

}