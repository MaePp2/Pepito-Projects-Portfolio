/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ProjectLibs;

/**
 *
 * @author Keziah
 */
public class DamageReportDetails extends Equipment {
    private int id;
    private String name, assetcondition;
    private float quantity, price;

    public DamageReportDetails(int id, String name, String assetcondition, float quantity, float price) {
        super(id, name, assetcondition, quantity);
        this.price = price;
    }

    public float getPrice() {
        return price;
    }
}
