package forms;

import java.awt.Color;
import java.awt.Cursor;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.Insets;
import java.awt.Point;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.FocusEvent;
import java.awt.event.FocusListener;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.awt.event.MouseMotionAdapter;
import java.text.ParseException;
import javax.swing.BorderFactory;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JPasswordField;
import javax.swing.JTextField;
import javax.swing.border.Border;
import generatorpdf.GeneratorPDF;
import java.awt.FontFormatException;
import java.awt.Toolkit;
import java.io.File;
import java.io.IOException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import javax.swing.JFileChooser;
import javax.swing.JProgressBar;
import javax.swing.SwingConstants;
import utl.Conexao;

public class Login extends JPanel {
    private static JFrame frame;
//    private static final int width = 234, height = 162;
    private static final int largura = 334, altura = 282;
    private static boolean move;
    private static Point point = new Point();
    public static final JTextField email = new JTextField();
    public final JPasswordField senha = new JPasswordField();
    public JButton login = new JButton("Entrar");
    public JLabel logo = new JLabel(new ImageIcon("resources\\logo.png"));
    public JLabel errorSenha = new JLabel();
    public JLabel errorEmail = new JLabel();
    public JLabel warning = new JLabel();
    public Font ROBOTO;
    
    public Login() throws ParseException , FontFormatException, IOException {
        setPreferredSize(new Dimension(largura,altura));
        setBackground(Color.WHITE);
        setFocusable(true);
        setLayout(null);
        
        Border borderTop = BorderFactory.createMatteBorder(1,1,1,1,Color.WHITE);
        Border border = BorderFactory.createMatteBorder(1,1,1,1,Color.WHITE);
        setBorder(BorderFactory.createCompoundBorder(borderTop,border));
        
        frame.addMouseMotionListener(new MouseMotionAdapter() {
            @Override
            public void mouseDragged(MouseEvent e) {
                Point p = frame.getLocation();
                if(move) frame.setLocation(p.x + e.getX() - point.x, p.y + e.getY() - point.y);
            }
        });
        frame.addMouseListener(new MouseAdapter() {
            @Override
            public void mousePressed(MouseEvent e) {
                point.x = e.getX();
                point.y = e.getY();
                if(e.getY() <= 20) move = true;
            }
            @Override
            public void mouseReleased(MouseEvent e) {
                move = false;
            }
        });
        frame.setIconImage(Toolkit.getDefaultToolkit().getImage("resources\\logo_flat.png"));
        
        JButton close = new JButton(new ImageIcon("resources\\close.png"));
        close.setBounds(318,2,30,20);
        close.setForeground(Color.WHITE);
        close.setFocusPainted(false);
        close.setBorderPainted(false);
        close.setBackground(new Color(173,70,42));
        close.setCursor(new Cursor(Cursor.HAND_CURSOR));
        close.addActionListener(new ActionListener(){
            @Override
            public void actionPerformed(ActionEvent ae) {
                System.exit(0);
            }
        });
        add(close);
        
        JButton minimize = new JButton(new ImageIcon("resources\\minimize.png"));
        minimize.setBounds(288,2,30,20);
        minimize.setFocusPainted(false);
        minimize.setBorderPainted(false);
        minimize.setBackground(null);
        minimize.setCursor(new Cursor(Cursor.HAND_CURSOR));
        minimize.addActionListener(new ActionListener(){
            @Override
            public void actionPerformed(ActionEvent ae) {
                frame.setExtendedState(JFrame.ICONIFIED);
            }
        });
        add(minimize);
        
        
        JLabel title = new JLabel("Log In");
        title.setBounds(32,17,175,32);
        title.setForeground(new Color(31,149,242));
        title.setFont(new Font("Roboto",Font.CENTER_BASELINE,20));
        add(title);
        
        logo.setBounds(72,-20,206,206);
        logo.setBorder(BorderFactory.createMatteBorder(0,0,0,0,Color.WHITE));
        add(logo);
        
        warning.setBounds(85,150,180,14);
        warning.setFont(new Font("Roboto",Font.PLAIN,12));
        warning.setHorizontalTextPosition(SwingConstants.CENTER);
        warning.setForeground(Color.RED);
        warning.setBackground(new Color(0,0,0,0));
        warning.setVisible(false);
        add(warning);
        
        email.setBounds(38,165,270,32);
        email.setText("E-mail");
        email.setFont(new Font("Roboto",Font.PLAIN,18));
        email.setForeground(new Color(96,96,96));
        email.setBorder(BorderFactory.createMatteBorder(0,0,1,0,new Color(105,105,105)));
        email.addFocusListener(new FocusListener(){
            @Override
            public void focusGained(FocusEvent fe) {
                if(email.getText().equals("E-mail")) email.setText("");
                email.setBorder(BorderFactory.createMatteBorder(0,0,1,0,new Color(33,150,243)));
                email.setForeground(new Color(102,102,102));
                email.setBackground(Color.WHITE);
                errorEmail.setVisible(false);
                warning.setVisible(false);
            }
            
            @Override
            public void focusLost(FocusEvent fe) {
                if(email.getText().equals("")) email.setText("E-mail");
                email.setBorder(BorderFactory.createMatteBorder(0,0,1,0,new Color(105,105,105)));
            }
        });
        add(email);
        
        errorEmail.setBounds(280,170,24,24);
        errorEmail.setBorder(BorderFactory.createMatteBorder(0,0,1,0,Color.WHITE));
        errorEmail.setForeground(new Color(0,0,0,0));
        errorEmail.setBackground(new Color(0,0,0,0));
        errorEmail.setIcon(new ImageIcon("resources\\warning_small.png"));
        errorEmail.setOpaque(false);
        errorEmail.setVisible(false);
        add(errorEmail);
        
        senha.setBounds(38,215,270,32);
        senha.setText("Senha");
        senha.setFont(new Font("Roboto",Font.PLAIN,18));
        senha.setEchoChar('\u0000');
        senha.setForeground(new Color(96,96,96));
        senha.setBorder(BorderFactory.createMatteBorder(0,0,1,0,new Color(105,105,105)));
        senha.addFocusListener(new FocusListener(){
            @Override
            public void focusGained(FocusEvent fe) {
                if("Senha".equals(new String(senha.getPassword()))){
                    senha.setText("");
                    senha.setForeground(new Color(96,96,96));
                    senha.setEchoChar('•');
                }
                senha.setBorder(BorderFactory.createMatteBorder(0,0,1,0,new Color(33,150,243)));
                senha.setBackground(Color.WHITE);
                errorSenha.setVisible(false);
                warning.setVisible(false);
            }
            
            @Override
            public void focusLost(FocusEvent fe) {
                if("".equals(new String(senha.getPassword()))){
                    senha.setText("Senha");
                    senha.setForeground(new Color(136,136,136));
                    senha.setEchoChar('\u0000');
                }
                senha.setBorder(BorderFactory.createMatteBorder(0,0,1,0,new Color(105,105,105)));
            }
        });
        add(senha);
        
        errorSenha.setBounds(280,220,24,24);
        errorSenha.setBorder(BorderFactory.createMatteBorder(0,0,1,0,Color.WHITE));
        errorSenha.setForeground(new Color(0,0,0,0));
        errorSenha.setBackground(new Color(0,0,0,0));
        errorSenha.setIcon(new ImageIcon("resources\\warning_small.png"));
        errorSenha.setOpaque(false);
        errorSenha.setVisible(false);
        add(errorSenha);
        
        login.setBounds(125,260,90,35);
        login.setForeground(Color.WHITE);
        login.setFocusPainted(false);
        login.setBorderPainted(false);
        login.setBackground(new Color(33,150,243));
        login.setFont(new Font("Roboto",Font.BOLD,18));
        login.setMargin(new Insets(0,0,0,0));
        login.setCursor(new Cursor(Cursor.HAND_CURSOR));
        login.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                try {
                    BtnLoginActionPerformed(evt);
                } catch (SQLException ex) {
                    System.out.println("ERRO SQLException ["+ex.getMessage()+"]");
                } catch (InterruptedException ex) {
                    System.out.println("ERRO InterruptedException ["+ex.getMessage()+"]");
                }
            }
        });
        add(login);
    }
    
    public static void main(String[] args) throws ParseException, FontFormatException, IOException {
        frame = new JFrame();
        JPanel login = new Login();
        frame.add(login);
        frame.pack();
        frame.setTitle("FastTCC");
        frame.setResizable(false);
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setLocationRelativeTo(null);
        frame.dispose();
        frame.setUndecorated(true);
        frame.setVisible(true);
        email.grabFocus();
    }

    private void BtnLoginActionPerformed(ActionEvent evt) throws SQLException, InterruptedException {
        if (email.getText().equals("") || email.getText().equals("E-mail") || email.getText().length() == 0) {
            email.setBorder(BorderFactory.createMatteBorder(0,0,1,0,Color.RED));
            email.setForeground(new Color(160,6,6));
            email.setBackground(new Color(0,0,0,0));
            errorEmail.setVisible(true);
            warning.setVisible(true);
            warning.setText("Preencha corretamente o e-mail!");
        }
        else
        if (String.valueOf(senha.getPassword()).equals("Senha")) {
            senha.setBorder(BorderFactory.createMatteBorder(0,0,1,0,Color.RED));
            senha.setForeground(new Color(160,6,6));
            senha.setBackground(new Color(0,0,0,0));
            errorSenha.setVisible(true);
            warning.setVisible(true);
            warning.setText("Preencha corretamente a senha!");
        }
        else
        {
            final Thread formatar = new Thread() {
                @Override
                public void run() {
                    try {
                        JProgressBar barra = new JProgressBar();
                        barra.setBackground(new Color(157,157,157));
                        barra.setBounds(20,150,300,50);
                        barra.setFont(new Font("Roboto",Font.PLAIN,18));
                        barra.setStringPainted(true);
                        add(barra);
                        
                        for (int i = 1; i <= 100; i++) {
                            barra.setString("Formatando..."+i+"%");
                            barra.setValue(i);
                            sleep(20);
                        }
                        GeneratorPDF.formatar();
                    } catch (InterruptedException ex) {
                        System.out.println("Erro InterruptedException ["+ex.getMessage()+"]");
                    }
                    yield();
                }
            };
            
            new Thread() {
                @Override
                public void run() {
                    Connection conexao = null;
                    try {
                        conexao = Conexao.conectar();
                        if(conexao != null) {
                            login.setVisible(false);
                            email.setVisible(false);
                            senha.setVisible(false);

                            PreparedStatement ps = conexao.prepareStatement("SELECT u.email AS email,u.nome AS nome,u.senha AS senha,d.id AS iddoc,e.id AS idequipe FROM usuarios AS u INNER JOIN equipes AS e ON u.idequipe = e.id INNER JOIN documentos AS d ON d.idequipe = e.id WHERE u.email = ? AND u.senha = ?");
                            ps.setString(1,email.getText());
                            ps.setString(2,new String(senha.getPassword()));
                            ResultSet rs = ps.executeQuery();
                            if(rs.next()) {
                                if (rs.getString("email").equals(email.getText()) && rs.getString("senha").equals(String.valueOf(senha.getPassword()))) 
                                {
                                    logo.setVisible(false);
                                    
                                    JOptionPane.showMessageDialog(frame,"Olá, "+rs.getString("nome")+"!\n"
                                        + "Por favor, escolha um local para salvar seu documento","FastTCC - Formatador",
                                        JOptionPane.PLAIN_MESSAGE,new ImageIcon("resources\\doc_save.png"));
                                    JFileChooser escolha = new JFileChooser();
                                    escolha.setFileSelectionMode(JFileChooser.DIRECTORIES_ONLY);
                                    File diretorio;
                                    int opcao;
                                    while((opcao = escolha.showDialog(frame,"Escolher")) != JFileChooser.APPROVE_OPTION) {
                                        JOptionPane.showMessageDialog(frame,"Você não selecionou nenhum diretório!");
                                    }
                                    diretorio = escolha.getSelectedFile();
                                    GeneratorPDF.setRoot(diretorio.getAbsolutePath());
                                    GeneratorPDF.setValores(rs.getInt("iddoc"),rs.getInt("idequipe"));
                                    formatar.start();
                                    while(formatar.isAlive()) {
                                        if (GeneratorPDF.finalizado()) {
                                        JOptionPane.showMessageDialog(frame, "Pronto, " + rs.getString("nome") + "! Seu documento foi salvo!",
                                            "FastTCC - Formatador",JOptionPane.PLAIN_MESSAGE,new ImageIcon("resources\\doc_saved.png"));
                                            System.exit(0);
                                        }
                                    }
                                }
                            } else {
                                JOptionPane.showMessageDialog(frame,"Usuário e/ou senha inválidos!","FastTCC - Formatador",JOptionPane.WARNING_MESSAGE,new ImageIcon("resources\\warning_large.png"));
                                email.setVisible(true);
                                senha.setVisible(true);
                                login.setVisible(true);
                            }
                            ps.close();
                            rs.close();
                        } else  {
                            JOptionPane.showMessageDialog(frame, "Não há conexão com o banco de dados no momento!","FastTCC - Formatador",JOptionPane.PLAIN_MESSAGE,
                                new ImageIcon("resources\\no_connection.png"));
                        }
                    } catch(SQLException e) {
                        System.out.println("Erro SQLException ["+e.getMessage()+"]");
                    } finally {
                        Conexao.desconectar(conexao);
                    }
                }
            }.start();
            Thread.sleep(1400);
            Thread.yield();
            login.setEnabled(true);
        }
    }
}