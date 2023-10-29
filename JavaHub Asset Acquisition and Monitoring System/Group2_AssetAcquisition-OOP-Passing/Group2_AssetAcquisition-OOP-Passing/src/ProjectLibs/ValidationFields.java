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
public class ValidationFields implements IValidationStrategy {
    private String name; 
    private String username; 
    private String password; 
    
 public ValidationFields (String name, String username, String password) {
    this.name = name;
    this.username = username;
    this.password = password; 
}

    @Override
    public boolean doValidation(String name, String username, String password) {
        if (name.isEmpty() || username.isEmpty() || password.isEmpty()) {
        return true;
        }
           
        else {
        return false;
        }
    }
 
 
}
