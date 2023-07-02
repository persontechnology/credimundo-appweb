<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('welcome', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', url('/'));
});
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', route('home'));
});

// login
Breadcrumbs::for('login', function (BreadcrumbTrail $trail) {
    $trail->parent('welcome');
    $trail->push('Ingresar', route('login'));
});

// usuarios
Breadcrumbs::for('usuarios.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Usuarios', route('usuarios.index'));
});
Breadcrumbs::for('usuarios.create', function (BreadcrumbTrail $trail) {
    $trail->parent('usuarios.index');
    $trail->push('Nuevo', route('usuarios.create'));
});
Breadcrumbs::for('usuarios.edit', function (BreadcrumbTrail $trail,$user) {
    $trail->parent('usuarios.index');
    $trail->push('Editar', route('usuarios.edit',$user->id));
});

Breadcrumbs::for('usuarios.identificacion-foto', function (BreadcrumbTrail $trail,$user) {
    $trail->parent('usuarios.index');
    $trail->push('Identificación y Foto', route('usuarios.identificacion-foto',$user->id));
});


// tipo de cuentas
Breadcrumbs::for('tipo-cuentas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Tipo de cuenta', route('tipo-cuentas.index'));
});
Breadcrumbs::for('tipo-cuentas.create', function (BreadcrumbTrail $trail) {
    $trail->parent('tipo-cuentas.index');
    $trail->push('Nuevo', route('tipo-cuentas.create'));
});
Breadcrumbs::for('tipo-cuentas.edit', function (BreadcrumbTrail $trail, $tc) {
    $trail->parent('tipo-cuentas.index');
    $trail->push('Editar', route('tipo-cuentas.edit', $tc));
});

// tipo de transaciones
Breadcrumbs::for('tipo-transacciones.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Tipo de transacción', route('tipo-transacciones.index'));
});
Breadcrumbs::for('tipo-transacciones.create', function (BreadcrumbTrail $trail) {
    $trail->parent('tipo-transacciones.index');
    $trail->push('Nuevo', route('tipo-transacciones.create'));
});

Breadcrumbs::for('tipo-transacciones.edit', function (BreadcrumbTrail $trail, $tt) {
    $trail->parent('tipo-transacciones.index');
    $trail->push('Editar', route('tipo-transacciones.edit', $tt));
});

// cuentas de usuarios
Breadcrumbs::for('cuentas-usuario.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Cuentas de usuarios', route('cuentas-usuario.index'));
});
Breadcrumbs::for('cuentas-usuario.create', function (BreadcrumbTrail $trail) {
    $trail->parent('cuentas-usuario.index');
    $trail->push('Nuevo', route('cuentas-usuario.create'));
});

Breadcrumbs::for('cuentas-usuario.edit', function (BreadcrumbTrail $trail, $cu) {
    $trail->parent('cuentas-usuario.index');
    $trail->push('Editar', route('cuentas-usuario.edit', $cu->id));
});
Breadcrumbs::for('cuentas-usuario.show', function (BreadcrumbTrail $trail, $cu) {
    $trail->parent('cuentas-usuario.index');
    $trail->push('Detalle', route('cuentas-usuario.show', $cu->id));
});


// transacciones
Breadcrumbs::for('transacciones.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Transacciones', route('transacciones.index'));
});
Breadcrumbs::for('transacciones.create', function (BreadcrumbTrail $trail) {
    $trail->parent('transacciones.index');
    $trail->push('Nuevo', route('transacciones.create'));
});
Breadcrumbs::for('transacciones.show', function (BreadcrumbTrail $trail,$t) {
    $trail->parent('transacciones.index');
    $trail->push('Detalle', route('transacciones.show',$t->id));
});
Breadcrumbs::for('transacciones.edit', function (BreadcrumbTrail $trail,$t) {
    $trail->parent('transacciones.index');
    $trail->push('ANULAR', route('transacciones.edit',$t->id));
});

// tipo de creditos
Breadcrumbs::for('tipo-creditos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Tipo créditos', route('tipo-creditos.index'));
});
Breadcrumbs::for('tipo-creditos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('tipo-creditos.index');
    $trail->push('Nuevo', route('tipo-creditos.create'));
});
Breadcrumbs::for('tipo-creditos.edit', function (BreadcrumbTrail $trail,$tc) {
    $trail->parent('tipo-creditos.index');
    $trail->push('Editar', route('tipo-creditos.edit',$tc));
});

// creditos
Breadcrumbs::for('creditos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Créditos', route('creditos.index'));
});
Breadcrumbs::for('creditos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('creditos.index');
    $trail->push('Nuevo', route('creditos.create'));
});
Breadcrumbs::for('creditos.show', function (BreadcrumbTrail $trail,$c) {
    $trail->parent('creditos.index');
    $trail->push('Ver', route('creditos.show',$c));
});
Breadcrumbs::for('creditos.garantes', function (BreadcrumbTrail $trail,$c) {
    $trail->parent('creditos.show',$c);
    $trail->push('Garantes', route('creditos.garantes',$c));
});
Breadcrumbs::for('creditos.edit', function (BreadcrumbTrail $trail,$c) {
    $trail->parent('creditos.index');
    $trail->push('Editar', route('creditos.edit',$c));
});

// plazo fijo
Breadcrumbs::for('plazo-fijo.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Plazo fijo', route('plazo-fijo.index'));
});
Breadcrumbs::for('plazo-fijo.create', function (BreadcrumbTrail $trail) {
    $trail->parent('plazo-fijo.index');
    $trail->push('Nuevo', route('plazo-fijo.create'));
});
Breadcrumbs::for('plazo-fijo.show', function (BreadcrumbTrail $trail,$c) {
    $trail->parent('plazo-fijo.index');
    $trail->push('Ver', route('plazo-fijo.show',$c));
});
Breadcrumbs::for('plazo-fijo.edit', function (BreadcrumbTrail $trail,$c) {
    $trail->parent('plazo-fijo.index');
    $trail->push('Editar', route('plazo-fijo.edit',$c));
});