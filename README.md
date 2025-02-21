# 📄 Sistema de Gestión de Tareas con Microservicios en Laravel

Este proyecto consiste en desarrollar un sistema de gestión de tareas basado en **microservicios con Laravel**. La arquitectura estará diseñada para ser escalable, modular y segura, permitiendo que cada servicio sea independiente y pueda evolucionar de forma autónoma.

## 📌 Objetivos del proyecto

Desarrollar un sistema distribuido donde los usuarios puedan **registrarse**, **gestionar tareas**, **recibir notificaciones y manejar accesos de forma segura**.

## 📌 Requisitos del Proyecto

### 1️⃣ Requisitos Funcionales

- **Autenticación y Autorización:** Los usuarios deben poder registrarse, iniciar sesión y recibir tokens de acceso.
- **Gestión de Usuarios:** Administración de perfiles, roles y permisos.
- **Gestión de Tareas:** Crear, asignar, actualizar y eliminar tareas.
- **Notificaciones:** Envío de correos y notificaciones en tiempo real cuando cambia el estado de una tarea.
- **API Gateway:** Centralizar las solicitudes y validar la autenticación antes de redirigir a los microservicios.

### 2️⃣ Requisitos No Funcionales

- **Seguridad:** Uso de JWT y OAuth2 para proteger las comunicaciones.
- **Escalabilidad:** Arquitectura basada en microservicios para mejorar la distribución de carga.
- **Desempeño:** Uso de Redis para cache y RabbitMQ para comunicación asíncrona.
- **Alta disponibilidad:** Contenerización con Docker y orquestación con Kubernetes en producción.

## 📌 Microservicios y Tecnologías a Utilizar

| Microservicios            | Responsabilidad                                | Tecnologías                                  |
| ------------------------- | ---------------------------------------------- | -------------------------------------------- |
| **API Gateway**           | Manejo de solicitudes y validación de tokens   | Laravel + Laravel Octane + Redis + Nginx     |
| **Auth Service**          | Registro, login, manejo de JWT                 | Laravel Sanctum o Passport + MySQL + Redis   |
| **Users Service**         | CRUD de usuarios, roles y permisos             | Laravel + MySQL + Spatie Laravel Permissions |
| **Tasks Service**         | CRUD de tareas, asignación y cambios de estado | Laravel + MySQL + RabbitMQ                   |
| **Notifications Service** | Envío de emails y WebSockets                   | Laravel + Redis + WebSockets + Mailgun       |

## 📌 Flujo de Trabajo del Sistema

1. El usuario se registra o inicia sesión en **Auth Service** y recibe un **JWT**.
2. **API Gateway** recibe la solicitud y valida el token antes de redirigir a los microservicios.
3. **Users Service** permite consultar datos de usuarios y gestionar roles.
4. **Tasks Service** gestiona las tareas asignadas a los usuarios.
5. **Notifications Service** envía correos y notificaciones en tiempo real cuando hay cambios en las tareas.

## 📌 Despliegue y Monitoreo

- **Docker** + **Docker Compose** → Para contenerizar cada microservicio.
- **Kubernetes** → Para gestionar la infraestructura en producción.
- **Prometheus** + **Grafana** → Para monitoreo y métricas del sistema.
