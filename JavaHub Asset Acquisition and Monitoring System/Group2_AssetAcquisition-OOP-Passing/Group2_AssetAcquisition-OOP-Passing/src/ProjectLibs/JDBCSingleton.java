package ProjectLibs;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import ProjectApps.AddEquipment;
import java.sql.Connection;
import java.sql.DriverManager;  
import java.sql.PreparedStatement;
import java.sql.ResultSet;  
import java.sql.SQLException;  
import java.sql.Statement;
import java.util.ArrayList;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author ate
 */
public class JDBCSingleton {  
    // creating a JDBCSingleton class.  
    //static member holds only one instance of the JDBCSingleton class.  
    
    private static JDBCSingleton jdbc;
           
    //JDBCSingleton prevents the instantiation from any other class.  
    private JDBCSingleton() {  }  
        
    //Now we are providing global point of access.  
    public static JDBCSingleton getInstance() {    
        if (jdbc==null)  
        {  
            jdbc=new JDBCSingleton();  
        }  
        return jdbc;  
    }  
    
    // to get the connection from methods like insert, view etc.   
    public static Connection getConnection()throws ClassNotFoundException, SQLException  
    {  
        Connection con=null;
        PreparedStatement preparedStatement = null;
       
        //connecting to database
        try {
            con = DriverManager.getConnection("jdbc:mysql://localhost/assetdb", "root","");
            return con;
        } catch (SQLException ex) {
            Logger.getLogger(AddEquipment.class.getName()).log(Level.SEVERE, null, ex);
            return null;
        }
    }
    
    //creating database
    public void createDatabase() throws ClassNotFoundException {
        Connection con=null;
        PreparedStatement preparedStatement = null;
        
        try {
            con = DriverManager.getConnection("jdbc:mysql://localhost/", "root","");
            String sqlQuery = "CREATE DATABASE assetdb;";
            preparedStatement = con.prepareStatement(sqlQuery);
            int sqlQueryResult = preparedStatement.executeUpdate();
            System.out.println("Database created successfully...");
        } catch (SQLException e) {
            e.printStackTrace();
            System.out.println("Database already created...");
        }
    }
    
    //creating table
    public void createEquipmentList(String tableName) throws ClassNotFoundException {
        Connection con=null;
        PreparedStatement ps = null;
        
        try {
            con = this.getConnection();
            String sqlQuery = "CREATE TABLE " + tableName +
                              "(ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, " +
                              " name VARCHAR(255) NOT NULL, " + 
                              " assetcondition VARCHAR(255) NOT NULL, " + 
                              " quantity FLOAT NOT NULL);";
            ps = con.prepareStatement(sqlQuery);
            int sqlQueryResult = ps.executeUpdate();
            if(0 == sqlQueryResult) {
                System.out.println("New table created successfully...");
            }
            else {
                System.out.println("Error in creating table...");
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
    
    //creating table for the damagesreport
    public void createPurchasesList(String tableName) throws ClassNotFoundException {
        Connection con=null;
        PreparedStatement ps = null;
        
        try {
            con = this.getConnection();
            String sqlQuery = "CREATE TABLE " + tableName +
                              "_purchasesList(ID INTEGER NOT NULL PRIMARY KEY, " +
                              " name VARCHAR(255) NOT NULL, " + 
                              " assetcondition VARCHAR(255) NOT NULL, " + 
                              " quantity FLOAT NOT NULL, " +
                              " price FLOAT NOT NULL DEFAULT 0);";
            ps = con.prepareStatement(sqlQuery);
            int sqlQueryResult = ps.executeUpdate();
            if(0 == sqlQueryResult) {
                System.out.println("New table for purchases created successfully...");
            }
            else {
                System.out.println("Error in creating table for purchases...");
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
    
    //create table for users to register and login 
    public void createUsersList() throws ClassNotFoundException {
        Connection con=null;
        PreparedStatement ps = null;
        
        try {
            con = this.getConnection();
            String sqlQuery = "CREATE TABLE users" + 
                              "(ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, " +
                              " name VARCHAR(255) NOT NULL, " + 
                              " username VARCHAR(50) NOT NULL, " + 
                              " password VARCHAR (50) NOT NULL); ";
            ps = con.prepareStatement(sqlQuery);
            int sqlQueryResult = ps.executeUpdate();
            if(0 == sqlQueryResult) {
                System.out.println("New table for users created successfully...");
            }
            else {
                System.out.println("Error in creating table for users...");
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
            
    //to insert equipment into the table  
    public int insert(String tableName, String name, String assetcondition, String quantity) throws SQLException  
    {  
        Connection con = null;       
        PreparedStatement ps = null;  
        int ID = 0;
                
        try {  
            con = this.getConnection();  
            ps = con.prepareStatement("INSERT INTO " + tableName + "(name,assetcondition,quantity) values(?,?,?)", Statement.RETURN_GENERATED_KEYS);
            ps.setString(1,name);
            ps.setString(2,assetcondition);
            ps.setString(3,quantity);
            
            ps.executeUpdate();
            ResultSet rs = ps.getGeneratedKeys();
            if (rs.next()){
                ID = rs.getInt(1);
            }
            
        } catch (Exception e) { e.printStackTrace(); }
        
        finally{  
            if (ps!=null){  
                ps.close();  
            }
            if(con!=null){  
                con.close();  
            }   
        }  
        return ID;
    }
    
    public int insertPurchases(String tableName, String price, int ID) throws SQLException  
    {  
        Connection con = null;       
        PreparedStatement ps = null;
        int recordCounter = 0;
                
        try {  
            con = this.getConnection();
            
            String selQuery = "INSERT INTO " + tableName + "_purchaseslist(id,name,assetcondition,quantity,price) select id,name,assetcondition,quantity,(?) from " + tableName + " WHERE id = " + ID;
            
            ps = con.prepareStatement(selQuery);
            ps.setString(1, price);
            
            recordCounter= ps.executeUpdate();
        } catch (Exception e) { e.printStackTrace(); }
        
        finally{  
            if (ps!=null){  
                ps.close();
                ps.close(); 
            }
            if(con!=null){  
                con.close();  
            }   
        }  
        return recordCounter;
    }
  
    //to view the data from the database        
    public ArrayList<Equipment> getTableList(String tableName) throws SQLException, ClassNotFoundException  
    {  
        ArrayList<Equipment> tableList = new ArrayList<Equipment>();
        Connection con = null;
        
        con = this.getConnection();
        String query = "SELECT * FROM " + tableName;
            
        Statement st;
        ResultSet rs; 
                  
        try {
            
            st = con.createStatement();
            rs = st.executeQuery(query);
            Equipment equipment;
            
            while(rs.next())
            {
                equipment = new Equipment(rs.getInt("id"), rs.getString("name"),rs.getString("assetcondition"), Float.parseFloat(rs.getString("quantity")));
                tableList.add(equipment);
            }
            
        } catch (SQLException ex) {
            Logger.getLogger(AddEquipment.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        return tableList; 
    }
    
    public ArrayList<DamageReportDetails> getPurchasesList(String tableName) throws SQLException, ClassNotFoundException  
    {  
        ArrayList<DamageReportDetails> tableList = new ArrayList<DamageReportDetails>();
        Connection con = null;
        
        con = this.getConnection();
        String query = "SELECT * FROM " + tableName + "_purchaseslist";
            
        Statement st;
        ResultSet rs; 
                  
        try {
            
            st = con.createStatement();
            rs = st.executeQuery(query);
            DamageReportDetails purchases;
            
            while(rs.next())
            {
                purchases = new DamageReportDetails(rs.getInt("id"), rs.getString("name"),rs.getString("assetcondition"), Float.parseFloat(rs.getString("quantity")), Float.parseFloat(rs.getString("price")));
                tableList.add(purchases);
            }
            
        } catch (SQLException ex) {
            Logger.getLogger(AddEquipment.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        return tableList; 
    }
    
    public Equipment getTableRow(String tableName, int ID) throws SQLException, ClassNotFoundException  
    {  
        Connection con = null;
        PreparedStatement ps = null;
        Equipment equipment = null;
        
        con = this.getConnection();
        String query = "SELECT * FROM " + tableName + " WHERE id = ?";
        ps = con.prepareStatement(query);
        
        ps.setInt(1, ID);
        
        ResultSet rs; 
                  
        try {
            rs = ps.executeQuery();
            
            while(rs.next())
            {
                equipment = new Equipment(rs.getInt("id"), rs.getString("name"),rs.getString("assetcondition"), Float.parseFloat(rs.getString("quantity")));
            }
            
        } catch (SQLException ex) {
            Logger.getLogger(AddEquipment.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        return equipment; 
    }
        
    // to update the password for the given username
    public int update(String tableName, int ID, String name, String assetcondition, String quantity) throws SQLException  
    {  
        String UpdateQuery = null;
        Connection con = null;       
        PreparedStatement ps = null;
                
        try {  
            con = this.getConnection();  
            UpdateQuery = "UPDATE " + tableName + " SET name = ?, assetcondition = ?, quantity = ? WHERE ID = ?";
            
            ps = con.prepareStatement(UpdateQuery);
            
            ps.setString(1,name);
            ps.setString(2,assetcondition);
            ps.setString(3,quantity);

            ps.setInt(4, ID);
            
            ps.executeUpdate();         
        } catch (Exception e) { e.printStackTrace(); }
        
        finally{  
            if (ps!=null){  
                ps.close();  
            }
            if(con!=null){  
                con.close();  
            }   
        }  
        return ID;
    }
    
    public int updatePurchases(String tableName, int ID, String name, String assetcondition, String quantity, int price) throws SQLException  
    {  
        String UpdateQuery = null;
        Connection con = null;       
        PreparedStatement ps = null;
                
        try {  
            con = this.getConnection();  
            UpdateQuery = "UPDATE " + tableName + "_purchasesList SET name = ?, assetcondition = ?, quantity = ?, price = ? WHERE ID = ?";
            
            ps = con.prepareStatement(UpdateQuery);
            
            ps.setString(1,name);
            ps.setString(2,assetcondition);
            ps.setString(3,quantity);
            ps.setInt(4,price);

            ps.setInt(5, ID);
            
            ps.executeUpdate();         
        } catch (Exception e) { e.printStackTrace(); }
        
        finally{  
            if (ps!=null){  
                ps.close();  
            }
            if(con!=null){  
                con.close();  
            }   
        }  
        return ID;
    }
            
    // to delete the data from the database   
    public int delete(String tableName, int ID) throws SQLException{  
        Connection con = null;  
        int recordCounter = 0;
        
        try {  
            con = this.getConnection();  
            PreparedStatement ps = con.prepareStatement("DELETE FROM " + tableName + " where id = ?");
            
            ps.setInt(1, ID);
            
            recordCounter = ps.executeUpdate();
        } catch (Exception ex) {
            Logger.getLogger(AddEquipment.class.getName()).log(Level.SEVERE, null, ex);
        }   
        
        return recordCounter;  
    }
    
    public int countRows(String tableName) throws ClassNotFoundException {
        Connection con=null;
        int count = 0;
        
        //counting the number of rows
        try {
            con = this.getConnection();
            PreparedStatement ps = con.prepareStatement("SELECT COUNT(*) AS count FROM "+ tableName + ";");
//          count = ps.(count);
            
            ResultSet myRes = ps.executeQuery();
            
            while(myRes.next()){
                count = myRes.getInt("count");
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        
        return count;  
    }
}
