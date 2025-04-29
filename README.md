<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Guía para crear una API en Laravel 10</title>
</head>
<body>

  <h1>🚀 API REST en Laravel 10 - Paso a Paso</h1>

  <p>Este proyecto es una API REST construida con Laravel 10. A continuación se detallan los pasos para crearla desde cero.</p>

  <h2>🛠️ Requisitos</h2>
  <ul>
    <li>PHP &gt;= 8.1</li>
    <li>Composer</li>
    <li>MySQL o cualquier base de datos compatible</li>
    <li>Laravel 10</li>
    <li>Postman o herramienta similar para pruebas (opcional)</li>
  </ul>

  <h2>🧱 Paso a Paso</h2>

  <h3>1. Crear el proyecto Laravel</h3>
  <pre><code>composer create-project laravel/laravel nombre-proyecto-api
cd nombre-proyecto-api
</code></pre>

  <h3>2. Configurar el archivo <code>.env</code></h3>
  <pre><code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_bd
DB_USERNAME=usuario
DB_PASSWORD=contraseña
</code></pre>

  <h3>3. Crear modelo, migración y controlador</h3>
  <pre><code>php artisan make:model Producto -mc
</code></pre>

  <p>Esto crea:</p>
  <ul>
    <li>Modelo: <code>app/Models/Producto.php</code></li>
    <li>Controlador: <code>app/Http/Controllers/ProductoController.php</code></li>
    <li>Migración: <code>database/migrations/...create_productos_table.php</code></li>
  </ul>

  <h3>4. Definir los campos en la migración</h3>
  <pre><code>Schema::create('productos', function (Blueprint $table) {
    $table->id();
    $table->string('nombre');
    $table->decimal('precio', 8, 2);
    $table->integer('stock');
    $table->timestamps();
});
</code></pre>

  <h3>5. Ejecutar migraciones</h3>
  <pre><code>php artisan migrate
</code></pre>

  <h3>6. Crear rutas de la API</h3>
  <p>Edita el archivo <code>routes/api.php</code>:</p>
  <pre><code>use App\Http\Controllers\ProductoController;

Route::apiResource('productos', ProductoController::class);
</code></pre>

  <h3>7. Implementar métodos en el controlador</h3>
  <pre><code>namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index() {
        return Producto::all();
    }

    public function store(Request $request) {
        $producto = Producto::create($request->all());
        return response()->json($producto, 201);
    }

    public function show(Producto $producto) {
        return $producto;
    }

    public function update(Request $request, Producto $producto) {
        $producto->update($request->all());
        return response()->json($producto, 200);
    }

    public function destroy(Producto $producto) {
        $producto->delete();
        return response()->json(null, 204);
    }
}
</code></pre>

  <h3>8. Permitir asignación masiva (fillable)</h3>
  <p>En el modelo <code>app/Models/Producto.php</code>:</p>
  <pre><code>protected $fillable = ['nombre', 'precio', 'stock'];
</code></pre>

  <h3>9. Probar la API</h3>
  <p>Ejecuta el servidor:</p>
  <pre><code>php artisan serve
</code></pre>

  <p>Prueba los endpoints:</p>
  <ul>
    <li><code>GET /api/productos</code></li>
    <li><code>POST /api/productos</code></li>
    <li><code>GET /api/productos/{id}</code></li>
    <li><code>PUT /api/productos/{id}</code></li>
    <li><code>DELETE /api/productos/{id}</code></li>
  </ul>

  <h2>✅ Extras</h2>

  <h3>📦 Instalar Laravel Sanctum para autenticación (opcional)</h3>
  <pre><code>composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
</code></pre>

  <p>Agregar en <code>app/Http/Kernel.php</code>:</p>
  <pre><code>'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
</code></pre>

</body>
</html>
