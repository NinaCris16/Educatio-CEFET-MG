/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package obrasdoacervo.model.controller;

import java.io.IOException;
import java.net.URL;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.TextField;
import obrasdoacervo.model.ObrasDoAcervo;

/**
 *
 * @author Aluno
 */
public class PesquisarAutorController implements Initializable {
    private ObrasDoAcervo main;
    private com.mysql.jdbc.Connection link;

    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            // TODO
            link = (com.mysql.jdbc.Connection) DriverManager.getConnection("jdbc:mysql://localhost:3307/educatio", "root", "usbw");
        } catch (SQLException ex) {
            Logger.getLogger(EditaPeriodicosController.class.getName()).log(Level.SEVERE, null, ex);
        }
        if(link == null)
            System.out.println("Erro!");
        else
            System.out.println("Conexao feita com sucesso!");
            
    }
    
    
        public void setMain(ObrasDoAcervo main) {
        this.main = main;
    }
        
        @FXML
        public void voltar() throws IOException {
            main.abreInterfacePrincipal();
    }

        @FXML
        public void pesquisarAutores() throws IOException {    
        }
    
}
