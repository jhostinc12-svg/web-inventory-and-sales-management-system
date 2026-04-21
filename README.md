# Sistema de Control de Inventario y Ventas (TechZone)

## Descripción

TechZone es un sistema web desarrollado en PHP y MySQL que simula la gestión administrativa de una empresa tecnológica. La aplicación permite el manejo integral de clientes, productos y cotizaciones, integrando procesos de registro, control de inventario y seguimiento de operaciones.

El sistema fue diseñado para representar un entorno real de gestión empresarial, incorporando control de acceso mediante autenticación de usuarios, validaciones de datos y automatización de procesos clave como la actualización de inventario y el registro de transacciones.

---

## Objetivo

Desarrollar una aplicación web funcional que permita gestionar clientes, productos e inventario, aplicando buenas prácticas de programación y simulando procesos reales del entorno empresarial.

---

## Funcionalidades

* Autenticación de usuarios mediante sesiones y cookies
* Gestión de clientes (registro, consulta, edición y eliminación)
* Gestión de productos con control de stock
* Generación de cotizaciones dinámicas
* Cálculo automático de totales y subtotales
* Actualización automática del inventario en tiempo real
* Registro de historial de transacciones (auditoría)
* Validaciones de datos y control de errores
* Interfaz tipo dashboard para navegación centralizada

---

## Arquitectura del Sistema

El sistema está compuesto por una estructura modular basada en archivos PHP independientes que gestionan cada funcionalidad:

* Módulo de autenticación: login, validación y cierre de sesión
* Módulo de clientes: inserción, listado, modificación y eliminación
* Módulo de productos: gestión completa del inventario
* Módulo de cotización: procesamiento de ventas y actualización de stock
* Módulo de historial: registro y control de transacciones

---

## Base de Datos

Base de datos relacional en MySQL denominada `techzone`, compuesta por las siguientes tablas principales:

* **clientes**: almacenamiento de información de clientes
* **productos**: registro de productos con precio y stock
* **historial**: registro de transacciones realizadas

---

## Tecnologías Utilizadas

### Back-End

* PHP
* MySQL

### Front-End

* HTML
* CSS
* JavaScript (validaciones y confirmaciones)

### Entorno de Desarrollo

* XAMPP
* phpMyAdmin
* Visual Studio Code

---

## Instalación

1. Clonar el repositorio
2. Crear la base de datos `techzone` en MySQL
3. Importar las tablas correspondientes
4. Configurar el archivo `conexion.php` con las credenciales del servidor
5. Ejecutar el proyecto en un entorno local (XAMPP o similar)

---

## Validaciones del Sistema

* Restricción de acceso sin autenticación
* Control de stock disponible antes de generar cotizaciones
* Validación de campos obligatorios
* Confirmación previa a la eliminación de registros
* Manejo de errores en operaciones inválidas

---

## Objetivo Académico

Este proyecto fue desarrollado como parte del curso de Programación Web, con el propósito de aplicar conocimientos en desarrollo backend, bases de datos y diseño de interfaces, integrando funcionalidades que simulan un sistema empresarial real.

---
## Capturas del sistema

![Login](images/login.png)

---

## Autor

Jhostin Jean Casas George

---

