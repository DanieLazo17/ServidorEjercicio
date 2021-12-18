<?php
    error_reporting(-1);
    ini_set('display_errors', 1);

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Server\RequestHandlerInterface;
    use Slim\Factory\AppFactory;
    use Slim\Routing\RouteCollectorProxy;
    use Slim\Routing\RouteContext;

    require __DIR__ . '/../vendor/autoload.php';

    require __DIR__ . '/accesoADatos/AccesoDatos.php';
    require __DIR__ . '/entidades/Usuario.php';
    require __DIR__ . '/entidades/Cliente.php';
    require __DIR__ . '/controlador/UsuarioControlador.php';
    require __DIR__ . '/controlador/ClienteControlador.php';

    //Crear un objeto
    $app = AppFactory::create();

    //Interceptar paquete entrante
    $app->addErrorMiddleware(true,true,true);

    // Habilitar CORS
    $app->add(function (Request $request, RequestHandlerInterface $handler): Response {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://localhost:4200/')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });

    $app->group("/Usuario", function (RouteCollectorProxy $grupoUsuario) {
        $grupoUsuario->post('/Registro[/]', \UsuarioControlador::class . ':CrearUsuario' );
        $grupoUsuario->post("/Validacion[/]", \UsuarioControlador::class . ':ValidarUsuario' );
    });

    $app->group("/Cliente", function (RouteCollectorProxy $grupoCliente) {
        $grupoCliente->post('/Informacion/{id}[/]', \ClienteControlador::class . ':TraerInfo' );
        $grupoCliente->post('/Correo/{id}[/]', \ClienteControlador::class . ':ActualizarEmail' );
        $grupoCliente->post('/Nombre/{id}[/]', \ClienteControlador::class . ':ActualizarNombre' );
        $grupoCliente->post('/Apellido/{id}[/]', \ClienteControlador::class . ':ActualizarApellido' );
        $grupoCliente->post('/DNI/{id}[/]', \ClienteControlador::class . ':ActualizarDNI' );
    });

    $app->get('[/]', function (Request $request, Response $response, array $args) {
        $response->getBody()->write("Bienvenido");
        return $response;
    });

    $app->run();
?>