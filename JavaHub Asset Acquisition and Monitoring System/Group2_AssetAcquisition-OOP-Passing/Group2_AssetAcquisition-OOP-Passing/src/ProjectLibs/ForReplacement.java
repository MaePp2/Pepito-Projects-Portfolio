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
public class ForReplacement implements ICondition {

    @Override
    public boolean equipmentCondition() {
        return false;
    }

    @Override
    public String conditionName() {
        return "For replacement";
    }
    
}
