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

## 📸 Capturas de Pantalla
> *Nota al alumno: Arrastra aquí tus capturas una vez subidas al repo.*
1. **Landing Page:** Diseño moderno de bienvenida.
2. **El Vestuario:** Panel central de gestión de plantilla.
3. **Detalles del Partido:** Integración de mapa y clima.

## 🔧 Instalación y Uso
1. Clonar: `git clone https://github.com/tu-usuario/nombre-repo.git`
2. Instalar PHP: `composer install`
3. Instalar Assets: `npm install && npm run build`
4. Base de Datos: `php artisan migrate --seed`
5. Servidor: `php artisan serve`

---
**Desarrollado por [Tu Nombre]**  
*Proyecto Final de Grado Superior (DAW) - IES Playamar*
