/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package dto;

/**
 *
 * @author Miquel
 */
public class Usuari {
    private String Nom;
    private int Id;
    private String Llinatges;
    private String Email;
    private String Password;
    private Boolean Admin;
    
    public Usuari() {
    }

    public String getNom() {
        return Nom;
    }

    public void setNom(String Nom) {
        this.Nom = Nom;
    }

    public int getId() {
        return Id;
    }

    public void setId(int Id) {
        this.Id = Id;
    }

    public String getLLinatges() {
        return Llinatges;
    }

    public void setLlinatges(String LLinatges) {
        this.Llinatges = LLinatges;
    }

    public String getEmail() {
        return Email;
    }

    public void setEmail(String Email) {
        this.Email = Email;
    }

    public String getPassword() {
        return Password;
    }

    public void setPassword(String Password) {
        this.Password = Password;
    }

    public Boolean getAdmin() {
        return Admin;
    }

    public void setAdmin(Boolean Admin) {
        this.Admin = Admin;
    }
    
   
    
}
