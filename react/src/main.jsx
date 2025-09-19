// import { StrictMode } from 'react'
// import { createRoot } from 'react-dom/client'
// import './index.css'
// import App from './App.jsx'
// // src/main.jsx
// import 'bootstrap/dist/css/bootstrap.min.css';
// import 'bootstrap/dist/js/bootstrap.bundle.min.js';
// // src/main.jsx
// import '@fortawesome/fontawesome-free/css/all.min.css';
//
// createRoot(document.getElementById('root')).render(
//   <StrictMode>
//     <App />
//   </StrictMode>,
// )
import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
// import App from './App.jsx'
// import 'bootstrap/dist/css/bootstrap.min.css'
// import 'bootstrap/dist/js/bootstrap.bundle.min.js'
// import './index.css'
// 1) Bootstrap ПЪРВИ (за .btn, .container-fluid, .dropdown-*)
import 'bootstrap/dist/css/bootstrap.min.css'

// 2) Tailwind (твоя index.css с @tailwind base/components/utilities)
import './index.css'

// 3) Laravel-ският app.css НАКРАЯ (за .header-nav, .mobile-nav-dropdown, .page-layout, #sidebar)
import '../public/css/app.css'

// 4) Bootstrap JS (за dropdown анимации/utility класове)
import 'bootstrap/dist/js/bootstrap.bundle.min.js'

// Font Awesome - или остави CDN в index.html, или импортирай NPM варианта:
import '@fortawesome/fontawesome-free/css/all.min.css'

import App from './App.jsx'

// Добавете FontAwesome через CDN
const addFontAwesome = () => {
    const link = document.createElement('link')
    link.rel = 'stylesheet'
    link.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'
    document.head.appendChild(link)
}
addFontAwesome()

createRoot(document.getElementById('root')).render(
    <StrictMode>
        <App />
    </StrictMode>,
)
