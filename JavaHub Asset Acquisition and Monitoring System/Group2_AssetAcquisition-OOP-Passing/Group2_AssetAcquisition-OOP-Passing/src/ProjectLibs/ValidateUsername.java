/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ProjectLibs;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JOptionPane;

/**
 *
 * @author Alyssa
 */
public class ValidateUsername implements IValidationStrategy {
    
    private String username; 
    
    public ValidateUsername (String username) {
        this.username = username; 
    }
    
    public Connection getConnection()
    {
        Connection con = null;
        
        try {
            con = DriverManager.getConnection("jdbc:mysql://localhost/assetdb", "root","");
            return con;
        } catch (SQLException ex) {
            Logger.getLogger(ValidateUsername.class.getName()).log(Level.SEVERE, null, ex);
            return null;
        }
    }
       
        
    @Override
    public boolean doValidation(String name, String username, String password) {
            PreparedStatement ps; 
            ResultSet rs; 
            boolean existingUsername = false;
            
            try {
                Connection con = getConnection();
                ps = con.prepareStatement("SELECT * FROM `users` WHERE `username` = ?");
                ps.setString(1, username);
                rs = ps.executeQuery(); 
                
                if (rs.next()) {
                    existingUsername = true;
                }
            } 
            
            catch (Exception ex) {
             JOptionPane.showMessageDialog(null, ex.getMessage()); 
            }
            
            return existingUsername;
    }
    
}
