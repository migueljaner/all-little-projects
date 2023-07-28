/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package dto;

/**
 *
 * @author Miquel
 */
public class Municipi {

    private int id;
    private String nom;

    public Municipi() {
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public int getId() {
        return id;
    }

    public String getNom() {
        return nom;
    }

    public String[] toArrayString() {
        String [] municipi = new String[2];
        municipi[0] = String.valueOf(id);
        municipi[1] = nom;
        return  municipi;
    }

    @Override
    public String toString() {
        return nom;
    }
}
