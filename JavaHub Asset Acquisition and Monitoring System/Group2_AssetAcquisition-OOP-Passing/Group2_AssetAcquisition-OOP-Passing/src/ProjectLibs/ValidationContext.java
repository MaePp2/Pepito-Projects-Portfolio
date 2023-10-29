/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ProjectLibs;

/**
 *
 * @author Alyssa
 */
public class ValidationContext {
     private IValidationStrategy strategy; 
    
    public ValidationContext (IValidationStrategy strategy) {
        this.strategy = strategy;
    }
    
    public boolean executeValidation (String name, String username, String password) {
        return strategy.doValidation(name, username, password);
    }
}
