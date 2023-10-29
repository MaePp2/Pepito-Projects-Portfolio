package ProjectLibs;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Keziah
 */
public class GoodCondition implements ICondition {

    @Override
    public boolean equipmentCondition() {
        return true;
    }

    @Override
    public String conditionName() {
        return "Good condition";
    }
    
}
