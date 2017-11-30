package utl;

import java.sql.Connection;
import java.sql.SQLException;
import java.sql.DriverManager;

public class Conexao {
    public static Connection conectar() {
        Connection conexao = null;
        try {
            Class.forName("com.mysql.jdbc.Driver");
            conexao = DriverManager.getConnection("jdbc:mysql://localhost:3306/fasttcc?user=root&password=&useSSL=false");
            System.out.println("Conexão estabelecida com sucesso! Conectado agora com fasttcc");
        } catch (SQLException e) {
            System.err.println("Erro SQLException: ["+e.getMessage()+"]");
        } catch(ClassNotFoundException e) {
            System.err.println("Erro ClassNotFound: ["+e.getMessage()+"]");
        } catch(Exception e) {
            System.err.println("Erro Exception: ["+e.getMessage()+"]");
        }
        return conexao;
    }
    
    public static void desconectar(Connection conexao) {
        try {
            conexao.close();
            System.out.println("Conexão encerrada com sucesso!");
        } catch (SQLException e) {
            System.err.println("Erro SQLException: ["+e.getMessage()+"]");
        } catch (Exception e) {
            System.err.println("Erro Exception: ["+e.getMessage()+"]");
        }
    }
}