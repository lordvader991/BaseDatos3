import 'package:mysql1/mysql1.dart';

class DatabaseHelper {
  late MySqlConnection _connection;

  DatabaseHelper() {
    // Inicializa la conexión en el constructor
    openConnection();
  }

  Future<void> openConnection() async {
    _connection = await MySqlConnection.connect(ConnectionSettings(
      host: '127.0.0.1', // o '127.0.0.1' si el servidor MySQL está en la misma máquina
      port: 3306,
      user: 'root',
      password: '', // Coloca aquí tu contraseña de MySQL
      db: 'ventas_db',
    ));
  }

  Future<MySqlConnection> getConnection() async {
    return _connection;
  }

  Future<void> closeConnection() async {
    await _connection.close();
  }
}
