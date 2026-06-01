# ⚽ SportManager: Gestión Integral de Equipos Amateur

![Laravel](https://img.shields.io/badge/Framework-Laravel%2011-red?style=for-the-badge&logo=laravel)
![Tailwind](https://img.shields.io/badge/CSS-Tailwind-blue?style=for-the-badge&logo=tailwind-css)
![JS](https://img.shields.io/badge/JS-Vanilla-yellow?style=for-the-badge&logo=javascript)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

## 📖 Descripción
**SportManager** es una solución web "Full-Stack" diseñada para eliminar el caos organizativo en los deportes aficionados. La aplicación permite digitalizar el ciclo de vida de un equipo, desde la captación de jugadores mediante tokens de seguridad hasta el registro oficial de actas y resultados.

## 🚀 Funcionalidades Principales
- **Sistema de Roles Dinámico:** Distinción administrativa entre **Capitán** (gestor) y **Jugador** (usuario).
- **Convocatorias Inteligentes:** Creación de partidos con división automática de costes de reserva entre asistentes.
- **Muro de Comunicación:** Sistema de comentarios en tiempo real para cada encuentro.
- **Historial de Resultados:** Registro histórico de marcadores y goleadores (Sala de Trofeos).
- **Perfil de Usuario:** Personalización de datos y fotografía de ficha deportiva.

## 🛠️ Stack Tecnológico & Integraciones
| Tecnología | Uso |
| :--- | :--- |
| **Laravel 11** | Motor Backend, Eloquent ORM y Sistema de Autenticación. |
| **MySQL** | Base de datos relacional (6 tablas interconectadas). |
| **Tailwind CSS** | Diseño de interfaz minimalista y corporativo. |
| **OpenWeather API** | Pronóstico meteorológico en tiempo real según la fecha del partido. |
| **Leaflet & OSM** | Geolocalización dinámica de las instalaciones deportivas. |

## 📸 Galería del Proyecto

### 1. Escaparate y Acceso
**Landing Page** - Portada corporativa presentando los servicios.
<img width="1819" height="912" alt="image" src="https://github.com/user-attachments/assets/c7ff181e-21b6-4802-91b9-60fc4cc740d7" />


**Autenticación** - Pantallas de Login y Registro minimalistas.
<img width="453" height="666" alt="image" src="https://github.com/user-attachments/assets/6ee8bf5c-0765-4a5d-aace-fe74bf9df0bd" />


### 2. Panel Principal del Usuario
**Mis Equipos** - Dashboard en cuadrícula con los equipos a los que pertenece el usuario.
<img width="1358" height="639" alt="image" src="https://github.com/user-attachments/assets/0ebc85c4-7beb-4a59-9479-8449e89cbf12" />


**Formularios de Acción** - Vistas limpias para crear o unirse a un equipo mediante Token.
<img width="780" height="561" alt="image" src="https://github.com/user-attachments/assets/339de4e1-1a05-41d7-92da-e8d61550638d" />


### 3. Gestión Interna del Club
**El Vestuario** - Panel central con la plantilla, próximos eventos y panel de administración exclusivo del capitán.
<img width="1452" height="751" alt="image" src="https://github.com/user-attachments/assets/2ff91bce-ae93-4435-a5fd-658f328d9977" />


**Rendimiento y Estadísticas** - KPIs globales del club y podio de asistencia de jugadores.
<img width="1418" height="674" alt="image" src="https://github.com/user-attachments/assets/e7fc91ed-29b1-40c3-9d86-a5709eae9d01" />


**Sala de Trofeos** - Historial inmutable con los marcadores de los partidos finalizados.
<img width="1338" height="611" alt="image" src="https://github.com/user-attachments/assets/01bb0cc7-f9c5-4435-8325-c208f3a2d891" />


### 4. El Partido en Detalle
**Convocatoria Oficial** - Vista con la geolocalización (Mapas), el pronóstico en tiempo real (Clima), la división de gastos y el muro interactivo.
<img width="1282" height="865" alt="image" src="https://github.com/user-attachments/assets/edfb24f0-856a-40cc-a65c-569dfbaa0e27" />
<img width="994" height="196" alt="image" src="https://github.com/user-attachments/assets/fdf81086-e18b-493e-a529-3c88cd95f246" />


## 🔧 Instalación y Uso
1. Clonar: `[git clone https://github.com/albertomancera/el-vestuario.git ]`
2. Instalar PHP: `composer install`
3. Instalar Assets: `npm install && npm run build`
4. Base de Datos: `php artisan migrate --seed`
5. Servidor: `php artisan serve`

---
**Desarrollado por Alberto Mancera Plaza**  
*Proyecto Final de Grado Superior (DAW) - IES Playamar*
