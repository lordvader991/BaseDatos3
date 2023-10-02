class Product {
  final int id;
  final String name;
  final String description;
  final double price;

  Product({required this.id, required this.name, required this.description, required this.price});

  factory Product.fromMap(Map<String, dynamic> map) {
    return Product(
      id: map['id'],
      name: map['nombre'],
      description: map['descripcion'],
      price: map['precio'].toDouble(),
    );
  }
}
