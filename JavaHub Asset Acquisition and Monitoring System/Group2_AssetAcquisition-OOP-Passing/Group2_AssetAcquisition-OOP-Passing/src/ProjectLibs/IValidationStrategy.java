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
public interface IValidationStrategy {
    public boolean doValidation(String name, String username, String password);
}
