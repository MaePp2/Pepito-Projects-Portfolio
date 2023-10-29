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
public class ConditionFactory extends IFactory{
    private ICondition condition;
    private String status;

    @Override
    protected ICondition createCondition(int conRequest) {
        if (conRequest == 0){
            condition = new GoodCondition();
            //return "No repairs needed.";
        }
        else if (conRequest == 1){
            condition = new NeedsRepair();
            //return "Generate repair report.";
        }
        else if (conRequest == 2){
            condition = new ForReplacement();
            //return "Book replacement order";
        }
        else if (conRequest == 3){
            condition = new LostEquipment();
            //return "Generate report on lost equipment.";
        }
        
        return condition;
    }

    @Override
    protected String status(int index) {
        if (index == 0){
            return "No repairs needed.";
        }
        else if (index == 1){
            return "Generate repair report.";
        }
        else if (index == 2){
            return "Book replacement order";
        }
        else if (index == 3){
            return "Generate report on lost equipment.";
        }
        
        return status;
    }

    
}
