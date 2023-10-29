/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ProjectLibs;

import javax.swing.JOptionPane;

/**
 *
 * @author Alyssa
 */
public class ValidatePassword implements IValidationStrategy {
    
    private String password; 
    
    public ValidatePassword (String password) {
        this.password = password; 
    }
    
    @Override
    public boolean doValidation (String name, String username, String password) {
        
            int fiveChars = password.length();
                
            if (fiveChars < 5) {
                return true;
            }
            
            else {
                return false;
            }
    }
    
}
