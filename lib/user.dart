import 'package:sqljocky5/sqljocky.dart';

class User {
  MySqlConnection _connection;

  User(MySqlConnection connection) {
    _connection = connection;
  }

  Future<bool> authenticate(String username, String password) async {
    var results = await _connection.query(
        'SELECT * FROM users WHERE username = ? AND password = ?',
        [username, password]);

    return results.isNotEmpty;
  }
}
