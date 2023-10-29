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
public abstract class IFactory {
    protected abstract ICondition createCondition(int conRequest);
    protected abstract String status(int index);
    
    public ICondition doSomething (int conditionIndex)
    {
        ICondition condition = createCondition(conditionIndex);
        return condition;
    }
    
    public String statusReport(int conIndex)
    {
        String status = status(conIndex);
        return status;
    }
}
