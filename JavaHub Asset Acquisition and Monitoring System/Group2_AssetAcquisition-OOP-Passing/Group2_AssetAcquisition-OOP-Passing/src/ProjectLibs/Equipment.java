package ProjectLibs;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author ate
 */
public class Equipment {
    private int id;
    private String name, assetcondition;
    private float quantity;

    public Equipment(int id, String name, String assetcondition, float quantity) {
        this.id = id;
        this.name = name;
        this.assetcondition = assetcondition;
        this.quantity = quantity;
    }

    public int getId() {
        return id;
    }

    public float getQuantity() {
        return quantity;
    }

    public String getName() {
        return name;
    }

    public String getAssetcondition() {
        return assetcondition;
    }
}
