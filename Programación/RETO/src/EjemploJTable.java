import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import javax.swing.*;
import javax.swing.table.DefaultTableModel;

public class EjemploJTable {
    public static void main(String[] args) {
        // Variables de conexión, cambiar según corresponda
        final String url = "jdbc:mysql://database-1.cxymoooksu50.us-east-1.rds.amazonaws.com/red_culinary_sushi";
        final String user = "ubuntu";
        final String password = "ubuntuubuntu";

        try {
            // Establecer la conexión
            Connection con = DriverManager.getConnection(url, user, password);
            System.out.println("¡Felicidades! Se ha establecido la conexión");

            // Crear una declaración SQL
            Statement stmt = con.createStatement();

            // Ejecutar la consulta SQL para obtener los datos de la tabla clientes
            ResultSet rs = stmt.executeQuery("SELECT * FROM clientes");

            // Crear modelo de tabla
            DefaultTableModel model = new DefaultTableModel();

            // Agregar las columnas al modelo de tabla
            model.addColumn("ID");
            model.addColumn("Nombre");
            model.addColumn("Apellido");
            model.addColumn("Fecha de Nacimiento");
            model.addColumn("Correo Electrónico");
            model.addColumn("Teléfono");
            model.addColumn("Domicilio");

            // Agregar los datos de los clientes al modelo de tabla
            while (rs.next()) {
                model.addRow(new Object[] { 
                    rs.getInt("cliente_id"), 
                    rs.getString("nombre"), 
                    rs.getString("apellidos"), 
                    rs.getDate("fecha_nacimiento"), 
                    rs.getString("correo_electronico"), 
                    rs.getInt("telefono"), 
                    rs.getString("domicilio") 
                });
            }

            // Crear tabla y añadirle el modelo
            JTable table = new JTable(model);

            // Crear marco y añadirle la tabla
            JFrame frame = new JFrame();
            frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
            frame.add(new JScrollPane(table));

            // Mostrar marco
            frame.pack();
            frame.setVisible(true);

            // Cerrar la conexión JDBC
            con.close();
        } catch (SQLException e) {
            System.err.println("Error al conectar a la base de datos: " + e.getMessage());
        }
    }
}
