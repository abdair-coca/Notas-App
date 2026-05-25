# DESIGN.md — NotasApp
> Sistema de diseño completo. Este documento es la fuente de verdad para implementar la interfaz con Tailwind CSS.

---

## 1. Identidad visual

**Nombre:** NotasApp  
**Estética:** Flat cartoon — colores planos y vibrantes, bordes negros definidos, formas geométricas simples. Sin gradientes, sin sombras difusas, sin efectos de vidrio.  
**Referencia de tono:** Charlie and Lola meets neo-brutalism. Alegre, personal, directo.  
**Lo que hace memorable:** Las cards ligeramente rotadas, los bordes negros gruesos con sombra offset sólida, y el fondo de puntos sutiles sobre crema.

---

## 2. Colores

### 2.1 Fondo global
| Token | Valor | Uso |
|-------|-------|-----|
| `bg-app` | `#FFF8ED` | Fondo de toda la aplicación |
| `bg-dot` | `#E8D5B7` | Color de los puntos del patrón de fondo |

El fondo usa un patrón de puntos radiales:
```css
background-image: radial-gradient(circle, #E8D5B7 1.5px, transparent 1.5px);
background-size: 28px 28px;
```
En Tailwind, esto va en CSS inline o en `app.css` como utilidad personalizada.

---

### 2.2 Paleta principal
| Nombre | Hex | Uso |
|--------|-----|-----|
| Azul navbar | `#3B82F6` | Navbar, acentos primarios |
| Amarillo acción | `#FFD166` | Botones CTA, highlights, border-bottom activo en tabs |
| Negro borde | `#1C1C1C` | Todos los bordes, texto principal, sombras offset |
| Crema fondo | `#FFF8ED` | Fondo global |
| Blanco card | `#FFFFFF` | Cards de formulario, sidebars |

---

### 2.3 Colores de notas (elegibles por el usuario)
Cada nota tiene un color de fondo pastel + una barra de acento:

| Nombre | Fondo card | Color barra | Tailwind bg |
|--------|-----------|-------------|-------------|
| Rosa | `#FFE4F0` | `#FF6B6B` | `bg-[#FFE4F0]` |
| Celeste | `#E0F2FE` | `#3B82F6` | `bg-[#E0F2FE]` / `bg-sky-100` |
| Verde | `#D1FAE5` | `#10B981` | `bg-emerald-100` |
| Amarillo | `#FEF9C3` | `#F59E0B` | `bg-yellow-100` |
| Lila | `#EDE9FE` | `#8B5CF6` | `bg-violet-100` |
| Durazno | `#FFEDD5` | `#F97316` | `bg-orange-100` |
| Fucsia | `#FCE7F3` | `#EC4899` | `bg-pink-100` |
| Menta | `#ECFDF5` | `#34D399` | `bg-emerald-50` |

> **Regla:** La barra de acento va siempre al tope de la card, con `height: 6px`, `border-radius: 100px`, y `opacity: 60%`.

---

## 3. Tipografía

### 3.1 Fuentes
```html
<!-- En el <head> del layout -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
```

| Fuente | Rol | Pesos usados |
|--------|-----|-------------|
| **Baloo 2** | Display — títulos, labels, botones, navbar, tabs | 700, 800 |
| **Nunito** | Body — contenido de notas, inputs, textos secundarios | 400, 600, 700 |

### 3.2 Escala tipográfica
| Elemento | Fuente | Tamaño | Peso | Notas |
|----------|--------|--------|------|-------|
| Logo navbar | Baloo 2 | `text-2xl` (24px) | 800 | |
| Título de página | Baloo 2 | `text-2xl` / `text-3xl` | 800 | |
| Título de nota (card) | Baloo 2 | `text-base` (15–16px) | 800 | |
| Labels de formulario | Baloo 2 | `text-xs` | 700 | uppercase + letter-spacing |
| Botones | Baloo 2 | `text-sm`–`text-base` | 800 | |
| Tabs | Baloo 2 | `text-sm` (13px) | 700 | |
| Cuerpo de nota | Nunito | `text-xs`–`text-sm` | 400 | line-height: 1.55 |
| Fechas / metadata | Nunito | `text-xs` (10px) | 700 | uppercase |
| Texto secundario | Nunito | `text-sm` | 600 | color `#888` |

---

## 4. Bordes y sombras

### 4.1 Regla de oro
**Todo elemento interactivo o contenedor tiene borde `2.5px solid #1C1C1C`.**  
En Tailwind se implementa con clase custom o `border-2 border-[#1C1C1C]`.

### 4.2 Sombra offset (neo-brutalist)
La sombra es **sólida**, nunca difusa. Simula profundidad con un desplazamiento duro:

```css
box-shadow: 4px 4px 0 #1C1C1C;   /* default */
box-shadow: 6px 6px 0 #1C1C1C;   /* hover en cards */
box-shadow: 3px 3px 0 #1C1C1C;   /* botones secundarios */
```

En Tailwind con clase personalizada en `app.css`:
```css
.shadow-brutal { box-shadow: 4px 4px 0px #1C1C1C; }
.shadow-brutal-lg { box-shadow: 6px 6px 0px #1C1C1C; }
.shadow-brutal-sm { box-shadow: 3px 3px 0px #1C1C1C; }
```

### 4.3 Border radius
| Elemento | Valor | Tailwind |
|----------|-------|---------|
| Cards de notas | `20px` | `rounded-[20px]` |
| Formularios / containers | `20px` | `rounded-[20px]` |
| Botones pill | `100px` | `rounded-full` |
| Inputs | `12px` | `rounded-xl` |
| Color chips | `12px` | `rounded-xl` |
| Icon buttons | `50%` | `rounded-full` |
| Sidebar cards | `16px` | `rounded-2xl` |
| Badges | `100px` | `rounded-full` |
| Barra de color (nota) | `100px` | `rounded-full` |

---

## 5. Componentes

### 5.1 Navbar
```
bg: #3B82F6
border-bottom: 3px solid #1C1C1C
height: 62px
padding: 0 24px
layout: flex, space-between, items-center
```

**Logo:**
- Ícono en caja `34×34px`, `bg-[#FFD166]`, `border-2 border-[#1C1C1C]`, `rounded-[10px]`
- Texto "NotasApp" en Baloo 2, 24px/800, color `#FFF8ED`
- Punto decorativo: `10×10px`, `bg-[#FFD166]`, `rounded-full`, `border-2 border-[#1C1C1C]`

**Botones navbar:**
- Base: `bg-[#FFF8ED]`, `border-2 border-[#1C1C1C]`, `rounded-full`, Baloo 2/700/14px
- CTA (Nueva nota): `bg-[#FFD166]`
- Hover: `translateY(-2px)`, cambio de fondo

---

### 5.2 Tab bar
```
bg: #FFF8ED
border-bottom: 2px solid #1C1C1C
padding: 0 24px
```

**Tab inactivo:** Baloo 2, 13px/700, color `#888`, `border-bottom: 3px solid transparent`  
**Tab activo:** color `#1C1C1C`, `border-bottom: 3px solid #FFD166`  
**Hover:** color `#3B82F6`

---

### 5.3 Note Card
```css
border: 2.5px solid #1C1C1C;
border-radius: 20px;
padding: 16px;
transition: transform 0.18s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.18s;
```

**Estructura interna:**
1. Barra de color — `h-1.5`, `rounded-full`, `opacity-60`, `mb-2.5`
2. Título — Baloo 2, 15px/800, `#1C1C1C`
3. Cuerpo — Nunito, 12px/400, `#555`, 2 líneas max (`line-clamp-2`)
4. Footer — flex, space-between: fecha a la izq, acciones a la der

**Rotación sutil por card (alterna):**
- Card 1: `rotate-0`
- Card 2: `rotate-[0.6deg]`
- Card 3: `-rotate-[0.5deg]`
- Card 4: `rotate-[0.4deg]`
- Card 5: `-rotate-[0.3deg]`
- Card 6: `rotate-[0.7deg]`

**Hover state:**
```css
transform: translateY(-5px) rotate(-1deg);
box-shadow: 6px 6px 0 #1C1C1C;
```

**Patrón de textura interna (sutil):**
```css
background-image: repeating-linear-gradient(
  -45deg,
  transparent, transparent 12px,
  rgba(0,0,0,0.025) 12px, rgba(0,0,0,0.025) 13px
);
```

---

### 5.4 Icon Buttons (acciones de card)
```
width: 28px, height: 28px
border: 2px solid #1C1C1C
border-radius: 50%
background: white
font-size: 12px
```
- Hover normal: `scale(1.15)`, `bg-[#FFD166]`
- Hover danger (eliminar): `bg-[#FF6B6B]`

---

### 5.5 Botones principales (CTA)
```css
font-family: 'Baloo 2';
font-weight: 800;
background: #FFD166;
color: #1C1C1C;
border: 2.5px solid #1C1C1C;
border-radius: 100px;
padding: 10px 28px;
box-shadow: 4px 4px 0 #1C1C1C;
display: inline-flex;
align-items: center;
gap: 8px;
```
Hover: `translateY(-3px)`, `box-shadow: 6px 6px 0 #1C1C1C`

**Variante secundaria / cancelar:**
```css
background: white;
border-color: #ddd;
color: #888;
box-shadow: 3px 3px 0 #ddd;
```

---

### 5.6 Inputs y Textarea
```css
background: #FFF8ED;
border: 2.5px solid #1C1C1C;
border-radius: 12px;
padding: 10px 14px;
font-family: 'Nunito';
font-size: 14px;
color: #1C1C1C;
width: 100%;
outline: none;
```
Focus: `box-shadow: 4px 4px 0 #1C1C1C`

---

### 5.7 Color Picker (selector de color de nota)
Grid de 4 columnas, chips cuadrados con aspect-ratio 1:1.

```css
/* Chip */
border: 2.5px solid #1C1C1C;
border-radius: 12px;
cursor: pointer;
transition: transform 0.15s;
```
- Hover: `scale(1.1)`
- Seleccionado: `box-shadow: 3px 3px 0 #1C1C1C`, `scale(1.08)`, checkmark `✓` centrado

---

### 5.8 Search Bar
```
background: white
border: 2.5px solid #1C1C1C
border-radius: 100px
padding: 6px 14px
width: 200px
layout: flex, items-center, gap-8px
```
Input interno: sin border, sin outline, Nunito 13px, background transparent.

---

### 5.9 Page Header
```
padding: 20px 24px 16px
layout: flex, space-between, items-start
```
- Título: Baloo 2, 26px/800, `#1C1C1C`
- Subtítulo: Nunito, 13px/600, `#888`

---

### 5.10 Alert / Success Banners
```
margin: 14px 24px 12px
border: 2.5px solid #1C1C1C
border-radius: 14px
padding: 10px 16px
layout: flex, items-center, gap-10px
font-family: Baloo 2, 14px/700
```
- Éxito: `bg-[#D1FAE5]` (verde esmeralda 100)
- Error: `bg-[#FFE4F0]` (rosa)
- Advertencia: `bg-[#FEF9C3]` (amarillo)

---

### 5.11 Badges / Tags
```css
font-family: 'Baloo 2';
font-size: 11px;
font-weight: 700;
padding: 3px 10px;
border-radius: 100px;
border: 2px solid #1C1C1C;
display: inline-block;
```

---

### 5.12 Sidebar Cards
```
background: white
border: 2.5px solid #1C1C1C
border-radius: 16px
padding: 14px
```
Label de sección: Baloo 2, 11px/700, uppercase, letter-spacing 1px, color `#aaa`

---

## 6. Layout

### 6.1 Grid de notas (index)
```css
display: grid;
grid-template-columns: repeat(3, 1fr);
gap: 16px;
padding: 0 24px 24px;
```
Responsive: en pantallas menores a `md` colapsa a 2 columnas, en `sm` a 1 columna.

### 6.2 Layout de formulario (crear / editar)
```css
display: grid;
grid-template-columns: 1fr 260px;
gap: 20px;
padding: 0 24px 24px;
```
Columna derecha: preview card + sidebar de ayuda.

### 6.3 Layout de vista detalle (show)
```css
display: grid;
grid-template-columns: 1fr 240px;
gap: 20px;
padding: 0 24px 24px;
```

---

## 7. Animaciones y transiciones

### 7.1 Card hover
```css
transition: transform 0.18s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.18s;
/* El cubic-bezier crea un efecto de "rebote" en el levantamiento */
```

### 7.2 Elementos flotantes decorativos
```css
@keyframes starFloat {
  0%, 100% { transform: translateY(0) rotate(0deg); }
  50%       { transform: translateY(-10px) rotate(15deg); }
}
/* duration: 4s, ease-in-out, infinite */
/* Aplicar con animation-delay escalonado: 0s, 1s, 2s, 0.5s */
```

### 7.3 Botones
- Hover: `transition: transform 150ms, box-shadow 150ms`
- Active: `scale(0.97)`

### 7.4 Inputs focus
```css
transition: box-shadow 150ms ease;
/* focus → box-shadow: 4px 4px 0 #1C1C1C */
```

### 7.5 Color chips
```css
transition: transform 150ms ease;
/* hover → scale(1.1) */
/* selected → scale(1.08) + box-shadow */
```

---

## 8. Elementos decorativos

### 8.1 Patrón de fondo
Puntos radiales en toda la app. Se aplica con `::before` en el contenedor raíz o como clase en el `<body>`:
```css
background-image: radial-gradient(circle, #E8D5B7 1.5px, transparent 1.5px);
background-size: 28px 28px;
opacity: (aplicado directamente al color, no al elemento)
```

### 8.2 Estrellas decorativas
Elementos `position: absolute`, `pointer-events: none`, `font-size: 18px`, `opacity: 0.35`.  
Símbolos usados: `✦` y `★`  
Ubicadas en esquinas y zonas vacías de cada vista.  
Animación `starFloat` con delays escalonados.

### 8.3 Patrón de textura en cards
```css
background-image: repeating-linear-gradient(
  -45deg,
  transparent, transparent 12px,
  rgba(0,0,0,0.025) 12px, rgba(0,0,0,0.025) 13px
);
```
Se aplica como `::after` sobre la card con `position: absolute; inset: 0; pointer-events: none`.

---

## 9. Flujo de vistas

```
Navbar (siempre visible)
└── Tab bar (siempre visible)
    ├── index   → Grid de notas + banner de éxito/error condicional
    ├── create  → Formulario 2 col (form | preview + sidebar)
    ├── show    → Detalle 2 col (nota | sidebar con metadata)
    ├── edit    → Formulario 2 col (mismo que create, pre-llenado)
    └── empty   → Estado vacío centrado
```

---

## 10. Estados especiales

### 10.1 Empty state (sin notas)
```
layout: flex-col, items-center, justify-center, text-center
padding-top: 30px
```
- Imagen/ilustración grande centrada (140px)
- Título: Baloo 2, 20px/800
- Subtítulo: Nunito, 13px, `#888`
- Botón CTA debajo

### 10.2 Preview card en tiempo real (create/edit)
- Se actualiza con `oninput` en título y cuerpo
- El fondo cambia dinámicamente según el color seleccionado
- Estado vacío: texto en cursiva, color `#aaa`/`#bbb`
- Estado con contenido: tipografía normal, colores reales

---

## 11. Configuración de Tailwind

Agregar en `tailwind.config.js` para las utilidades custom:

```js
module.exports = {
  theme: {
    extend: {
      fontFamily: {
        display: ['"Baloo 2"', 'cursive'],
        body: ['Nunito', 'sans-serif'],
      },
      colors: {
        app: {
          cream:   '#FFF8ED',
          navy:    '#3B82F6',
          yellow:  '#FFD166',
          black:   '#1C1C1C',
        },
        note: {
          pink:    '#FFE4F0',
          sky:     '#E0F2FE',
          green:   '#D1FAE5',
          yellow:  '#FEF9C3',
          violet:  '#EDE9FE',
          orange:  '#FFEDD5',
          fuchsia: '#FCE7F3',
          mint:    '#ECFDF5',
        },
        accent: {
          pink:    '#FF6B6B',
          blue:    '#3B82F6',
          green:   '#10B981',
          amber:   '#F59E0B',
          violet:  '#8B5CF6',
          orange:  '#F97316',
          fuchsia: '#EC4899',
          mint:    '#34D399',
        }
      },
      boxShadow: {
        'brutal':    '4px 4px 0px #1C1C1C',
        'brutal-lg': '6px 6px 0px #1C1C1C',
        'brutal-sm': '3px 3px 0px #1C1C1C',
        'brutal-muted-sm': '3px 3px 0px #ddd',
        'brutal-muted':    '4px 4px 0px #ddd',
      },
      borderRadius: {
        'card':  '20px',
        'chip':  '12px',
        'badge': '100px',
      },
      backgroundImage: {
        'dot-pattern': "radial-gradient(circle, #E8D5B7 1.5px, transparent 1.5px)",
      },
      backgroundSize: {
        'dot-28': '28px 28px',
      }
    }
  }
}
```

Y en `app.css`:
```css
@layer utilities {
  .bg-dot-pattern {
    background-image: radial-gradient(circle, #E8D5B7 1.5px, transparent 1.5px);
    background-size: 28px 28px;
  }
  .text-stroke-1 {
    -webkit-text-stroke: 1px #1C1C1C;
  }
}

@keyframes starFloat {
  0%, 100% { transform: translateY(0) rotate(0deg); }
  50%       { transform: translateY(-10px) rotate(15deg); }
}

@keyframes cardBounce {
  0%, 100% { transform: translateY(0); }
  50%       { transform: translateY(-8px); }
}

.animate-star-float {
  animation: starFloat 4s ease-in-out infinite;
}
```

---

## 12. Convenciones de implementación en Blade

### Estructura de archivos
```
resources/views/
├── layouts/
│   └── app.blade.php          ← Shell: <head>, navbar, tab-bar, scripts
├── notas/
│   ├── index.blade.php        ← Grid de notas + banner flash
│   ├── create.blade.php       ← Formulario crear
│   ├── show.blade.php         ← Vista detalle
│   └── edit.blade.php         ← Formulario editar (reutiliza partials)
└── partials/
    ├── _note-card.blade.php   ← Card reutilizable (recibe $nota)
    ├── _note-form.blade.php   ← Formulario compartido create/edit
    ├── _color-picker.blade.php
    ├── _navbar.blade.php
    └── _flash.blade.php       ← Banners success/error
```

### Color de nota en el modelo
El campo `color` en la tabla `notas` guarda el valor hex del fondo (ej: `#FFE4F0`).  
El color de la barra de acento se mapea en un helper o array:

```php
// En AppServiceProvider o helper
$accentColors = [
    '#FFE4F0' => '#FF6B6B',
    '#E0F2FE' => '#3B82F6',
    '#D1FAE5' => '#10B981',
    '#FEF9C3' => '#F59E0B',
    '#EDE9FE' => '#8B5CF6',
    '#FFEDD5' => '#F97316',
    '#FCE7F3' => '#EC4899',
    '#ECFDF5' => '#34D399',
];
```

### Rotación de cards en index
```blade
{{-- En el loop de notas --}}
@php
  $rotations = ['rotate-0','rotate-[0.6deg]','-rotate-[0.5deg]','rotate-[0.4deg]','-rotate-[0.3deg]','rotate-[0.7deg]'];
  $rot = $rotations[$loop->index % count($rotations)];
@endphp
<div class="note-card {{ $rot }} ...">
```

### Flash messages
```blade
{{-- En el layout o en index --}}
@if(session('success'))
  <div class="alert-banner bg-[#D1FAE5]">
    ✅ {{ session('success') }}
  </div>
@endif
@if(session('error'))
  <div class="alert-banner bg-[#FFE4F0]">
    ⚠️ {{ session('error') }}
  </div>
@endif
```

---

*Versión 1.0 — NotasApp Design System*