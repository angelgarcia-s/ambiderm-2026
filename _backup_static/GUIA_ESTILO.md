# Ambiderm Style Guide 2026

Esta guía define los principios de diseño, componentes y patrones de interacción para mantener la estética premium "Apple-inspired" de Ambiderm.

## 1. Fundamentos Visuales

### Paleta de Colores
| Uso | Color Hex / Clase | Descripción |
| :--- | :--- | :--- |
| **Fondo Principal** | `#ffffff` / `bg-white` | Usado en tarjetas y secciones limpias. |
| **Fondo Alterno** | `#f5f5f7` / `bg-[#f5f5f7]` | Fondo secundario para contraste (Hero, Productos). |
| **Texto Títulos** | `#1d1d1f` / `text-[#1d1d1f]` | Negro profundo para jerarquía máxima. |
| **Texto Cuerpo** | `#86868b` / `text-gray-500` | Gris refinado para descripciones. |
| **Acción (Azul)** | `#0071e3` / `bg-[#0071e3]` | Color de marca para botones y destacaos. |

### Degradados de Marca
- **Brand Gradient**: `from-blue-600 via-blue-400 to-cyan-400` (Usado en títulos Hero).
- **Medical Overlay**: `from-blue-950/90 via-blue-900/40 to-transparent` (Usado en tarjetas de soluciones).

### Tipografía
- **Fuente**: `Inter` (Sans-serif) con tracking tight (`tracking-tight`).
- **Escala Sugerida**:
    - Hero: `text-6xl` a `text-9xl`, `font-black`.
    - Título Sección: `text-4xl` a `text-5xl`, `font-bold`.
    - Card Title: `text-2xl` a `text-3xl`, `font-bold`.

---

## 2. Componentes Maestro

### Tarjetas de Producto (Product Card)
Estructura optimizada para centrar el producto y manejar interacción:
- **Contenedor**: `aspect-square`, `rounded-[40px]`, `flex flex-col justify-between`.
- **Imagen**: Contenedor `flex-1 flex items-center justify-center`. Imagen con `max-h-[160px] md:max-h-[240px]` y `mix-blend-multiply`.
- **Interacción**: El botón "Ver detalles" aparece en desktop mediante `opacity-0 group-hover:opacity-100`.

### Soluciones Médicas (Bento Style)
- **Overlay**: Uso obligatorio de degradado azul (`from-blue-950/90`) para garantizar la legibilidad del texto sobre fotos.
- **Imagen de Fondo**: `object-cover` con efecto `group-hover:scale-110`.

### Navegación
- **Efecto de Vidrio**: `bg-white/90 backdrop-blur-xl`.
- **Tracking**: Items en `text-[12px]` con `uppercase` y `tracking-tight`.

---

## 3. Animaciones (Reveal System)

Basado en Intersection Observer (`reveal.active`):
| Clase | Efecto | Uso |
| :--- | :--- | :--- |
| `.reveal-fade-in` | Desplazamiento + Opacidad | Títulos y párrafos. |
| `.reveal-scale-in` | Escala (0.9 a 1.0) | Imágenes y tarjetas. |

---

## 4. Lineamientos de Diseño

1. **Radios Uniformes**: Usar `rounded-[40px]` para contenedores principales y `rounded-full` para botones.
2. **Espaciado**: Mantener `py-32` para separaciones de secciones mayores (Desktop).
3. **Iconografía**: Lucide Icons con `stroke-width="1.5"`.
4. **Visual Focus**: Las fotos de producto deben estar limpias, preferiblemente centradas y con sombras suaves (`drop-shadow-2xl`).
