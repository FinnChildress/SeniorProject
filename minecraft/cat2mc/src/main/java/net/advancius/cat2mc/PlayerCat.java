package net.advancius.cat2mc;

import net.advancius.cat2mc.catbreeds.*;
import org.bukkit.Material;

public class PlayerCat {

    public String breed;
    public String name;
    public boolean baby;

    public String color;

    public PlayerCat(String breed, String name, boolean baby, String color) {
        this.breed = breed;
        this.name = name;
        this.baby = baby;
        this.color = color;
    }
    public CatBreed getBreed() {
        switch(breed)
        {
            case "Aphrodite Giant":
                return new CatBreed(breed,
                        3,4,2, 4, 1);
            case "Abyssinian":
                return new CatBreed(breed,
                        2,3,3, 3, 1);
            case "American Wirehair":
                return new CatBreed(breed,
                        5,3,3, 4, 2);
            case "Aegean":
                return new CatBreed(breed,
                        4,3,4, 5, 3);
            case "American Bobtail":
                return new CatBreed(breed,
                        4,4,3, 4, 1);
            case "Arabian Mau":
                return new CatBreed(breed,
                        4,2,3, 4, 2);
            case "American Curl":
                return new CatBreed(breed,
                        5,4,5, 5, 2);
            case "Asian":
                return new CatBreed(breed,
                        4,1,4, 5, 2);
            case "American Shorthair":
                return new CatBreed(breed,
                        4,3,3, 3, 3);
            case "Australian Mist":
                return new CatBreed(breed,
                        4,2,2, 5, 3);
            case "Balinese":
                return new CatBreed(breed,
                        2,3,1, 4, 2);
            case "Brazilian Shorthair":
                return new CatBreed(breed,
                        3,1,3, 4, 2);
            case "Bambino":
                return new CatBreed(breed,
                        3,1,3, 4, 3);
            case "British Longhair":
                return new CatBreed(breed,
                        3,4,3, 4, 4);
            case "Bengal Cats":
                return new CatBreed(breed,
                        3,2,2, 5, 1);
            case "British Shorthair":
                return new CatBreed(breed,
                        4,3,4, 3, 1);
            case "Burmese":
                return new CatBreed(breed,
                        2,2,3, 5, 2);
            case "Birman":
                return new CatBreed(breed,
                        2,3,4, 5, 1);
            case "Bombay":
                return new CatBreed(breed,
                        4,2,3, 4, 2);
            case "Burmilla":
                return new CatBreed(breed,
                        3,3,3, 4, 2);
            case "California Spangled":
                return new CatBreed(breed,
                        4,2,2, 4, 3);
            case "Colorpoint Shorthair":
                return new CatBreed(breed,
                        2,2,1, 5, 2);
            case "Chantilly-Tiffany":
                return new CatBreed(breed,
                        4,3,5, 4, 3);
            case "Cornish Rex":
                return new CatBreed(breed,
                        3,2,2, 5, 1);
            case "Chartreux":
                return new CatBreed(breed,
                        4,4,5, 3, 2);
            case "Cymric":
                return new CatBreed(breed,
                        3,4,2, 5, 3);
            case "Chausie":
                return new CatBreed(breed,
                        4,1,3, 4, 2);
            case "Cyprus":
                return new CatBreed(breed,
                        4,2,3, 4, 2);
            case "Chinese Li Hua":
                return new CatBreed(breed,
                        3,3,3, 3, 2);
            case "Desert Lynx":
                return new CatBreed(breed,
                        4,1,3, 4, 3);
            case "Devon Rex":
                return new CatBreed(breed,
                        1,1,3, 5, 2);
            case "Donskoy":
                return new CatBreed(breed,
                        3,1,3, 4, 2);
            case "Egyptian Mau":
                return new CatBreed(breed,
                        4,3,2, 5, 3);
            case "European Burmese":
                return new CatBreed(breed,
                        1,2,1, 5, 1);
            case "Exotic":
                return new CatBreed(breed,
                        2,3,5, 4, 3);
            case "European Shorthair":
                return new CatBreed(breed,
                        4,2,3, 4, 2);
            case "Foldex":
                return new CatBreed(breed,
                        4,3,3, 5, 2);
            case "German Rex":
                return new CatBreed(breed,
                        3,2,2, 4, 2);
            case "Havana Brown":
                return new CatBreed(breed,
                        4,3,3, 5, 2);
            case "Highlander":
                return new CatBreed(breed,
                        4,2,3, 4, 1);
            case "Himalayan":
                return new CatBreed(breed,
                        2,5,3, 4, 4);
            case "Javanese":
                return new CatBreed(breed,
                        2,3,1, 5, 2);
            case "Japanese Bobtail":
                return new CatBreed(breed,
                        4,3,1, 5, 1);
            case "Khao Manee":
                return new CatBreed(breed,
                        3,1,4, 4, 2);
            case "Korat":
                return new CatBreed(breed,
                        4,1,5, 5, 3);
            case "Kurilian Bobtail":
                return new CatBreed(breed,
                        3,2,3, 4, 2);
            case "Lykoi":
                return new CatBreed(breed,
                        3,4,3, 4, 3);
            case "LaPerm":
                return new CatBreed(breed,
                        4,2,5, 4, 2);
            case "Maine Coon":
                return new CatBreed(breed,
                        3,4,4, 3, 1);
            case "Manx":
                return new CatBreed(breed,
                        3,3,2, 4, 4);
            case "Mekong Bobtail":
                return new CatBreed(breed,
                        1,2,3, 4, 2);
            case "Norwegian Forest":
                return new CatBreed(breed,
                        2,4,4, 2, 2);
            case "Nebelung":
                return new CatBreed(breed,
                        4,4,2, 4, 3);
            case "Napoleon":
                return new CatBreed(breed,
                        3,3,2, 4, 2);
            case "Ocicat":
                return new CatBreed(breed,
                        3,2,2, 4, 3);
            case "Oriental Bicolor":
                return new CatBreed(breed,
                        3,1,5, 4, 3);
            case "Oriental":
                return new CatBreed(breed,
                        3,3,1, 3, 3);
            case "Pixie-Bob":
                return new CatBreed(breed,
                        5,4,3, 5, 2);
            case "Peterbald":
                return new CatBreed(breed,
                        3,1,4, 5, 2);
            case "Persian":
                return new CatBreed(breed,
                        2,5,3, 3, 4);
            case "Ragamuffin":
                return new CatBreed(breed,
                        4,4,3, 5, 1);
            case "Ragdoll Cats":
                return new CatBreed(breed,
                        3,4,4, 5, 2);
            case "Russian Blue":
                return new CatBreed(breed,
                        4,4,3, 4, 2);
            case "Savannah":
                return new CatBreed(breed,
                        5,3,3, 4, 1);
            case "Siberian":
                return new CatBreed(breed,
                        4,4,2, 5, 2);
            case "Sphynx":
                return new CatBreed(breed,
                        2,1,3, 5, 1);
            case "Singapura":
                return new CatBreed(breed,
                        4,2,5, 5, 2);
            case "Scottish Fold":
                return new CatBreed(breed,
                        3,3,4, 5, 2);
            case "Selkirk Rex":
                return new CatBreed(breed,
                        3,4,2, 4, 2);
            case "Snowshoe":
                return new CatBreed(breed,
                        5,3,2, 5, 2);
            case "Sokoke":
                return new CatBreed(breed,
                        3,1,3, 4, 2);
            case "Serengeti":
                return new CatBreed(breed,
                        3,1,5, 4, 2);
            case "Siamese Cat":
                return new CatBreed(breed,
                        3,2,5, 5, 2);
            case "Somali":
                return new CatBreed(breed,
                        2,4,3, 5, 1);
            case "Thai":
                return new CatBreed(breed,
                        4,2,5, 4, 2);
            case "Turkish Van":
                return new CatBreed(breed,
                        4,2,3, 3, 3);
            case "Thai Lilac":
                return new CatBreed(breed,
                        4,2,5, 4, 2);
            case "Tonkinese":
                return new CatBreed(breed,
                        2,2,1, 5, 2);
            case "Toyger":
                return new CatBreed(breed,
                        3,1,4, 5, 2);
            case "Turkish Angora":
                return new CatBreed(breed,
                        3,2,3, 5, 3);
            case "Ukrainian Levkoy":
                return new CatBreed(breed,
                        3,1,3, 5, 2);
            case "York Chocolate":
                return new CatBreed(breed,
                        3,4,4, 4, 3);
            default:
                return new TestCatBreed();
        }
    }

    public Material getMenuItem() {
        switch(color.toLowerCase())
        {
            case "black":
                return Material.BLACK_WOOL;
            case "british_shorthair":
                return Material.LIGHT_GRAY_WOOL;
            case "calico":
                return Material.ORANGE_WOOL;
            case "jellie":
                return Material.GRAY_WOOL;
            case "persian":
                return Material.YELLOW_WOOL;
            case "ragdoll":
                return Material.WHITE_WOOL;
            case "red":
                return Material.RED_WOOL;
            case "siamese":
                return Material.LIGHT_BLUE_WOOL;
            case "tabby":
                return Material.BROWN_WOOL;
            case "tuxedo":
                return Material.BLACK_WOOL;
            case "white":
                return Material.WHITE_WOOL;
            default:
                return Material.LIGHT_GRAY_WOOL;
        }
    }

}
