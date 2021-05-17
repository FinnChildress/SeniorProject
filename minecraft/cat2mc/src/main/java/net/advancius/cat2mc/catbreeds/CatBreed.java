package net.advancius.cat2mc.catbreeds;

public class CatBreed {

    private String breedName;
    private float health;
    private float shedding;
    private float vocalization;
    private float affection;
    private float aggression;

    public CatBreed(String breedName, int health, int shedding,
                    int vocalization, int affection, int aggression){
        this.breedName = breedName;
        this.health = (float)health;
        this.shedding = (float)shedding;
        this.vocalization = (float)vocalization;
        this.affection = (float)affection;
        this.aggression = (float)aggression;
    }
    public String getBreedName() {
        return breedName;
    }

    public float getHealth() {
        return health;
    }

    public float getShedding() {
        return shedding;
    }

    public float getVocalization() {
        return vocalization;
    }


    public float getAffection() {
        return affection;
    }

    public float getAggression() {
        return aggression;
    }
}
