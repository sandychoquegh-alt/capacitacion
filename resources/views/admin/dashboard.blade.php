<x-app-layout>

  

    <div class="p-6">
        Bienvenido Administrador
    </div>
<div style="padding:30px; background:#f8fafc; min-height:100vh;">

    <!-- 🔵 TITULO -->
    <h1 style="font-size:28px; font-weight:bold; margin-bottom:20px;">
        Dashboard Administrador
    </h1>

    <!-- 📊 CARDS -->
    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px;">

        <div style=" background: linear-gradient(135deg, #2563eb, #1d4ed8); color:white; padding:10px; border-radius:12px; box-shadow:0 10px 20px rgba(0,0,0,0.05);">
             <!-- ICONO -->
        <svg style="width:40px;height:40px;opacity:0.9;" fill="white" viewBox="0 0 24 24">
            <path d="M16 14c2.7 0 5 2.3 5 5v1h-6v-1c0-1.7-.7-3.2-1.9-4.3C14 14.4 15 14 16 14zm-8 0c2.7 0 5 2.3 5 5v1H3v-1c0-2.7 2.3-5 5-5zm0-2a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm8 0a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
        </svg>Usuarios
            <h2 style="font-size:24px;">{{ $usuarios }}</h2>
        </div>

        <div style="background: linear-gradient(135deg, #16a34a, #15803d);   color:white; padding:20px; border-radius:12px; box-shadow:0 10px 20px rgba(0,0,0,0.05);">
            <svg style="width:40px;height:40px;" fill="white" viewBox="0 0 24 24">
            <path d="M4 6h16v2H4V6zm0 4h16v10H4V10z"/>
        </svg> Cursos
            <h2 style="font-size:24px;">{{ $cursos }}</h2>
        </div>

        <div style="background: linear-gradient(135deg, #f59e0b, #d97706); color:white; padding:20px; border-radius:12px; box-shadow:0 10px 20px rgba(0,0,0,0.05);">
            <svg style="width:40px;height:40px;" fill="white" viewBox="0 0 24 24">
            <path d="M6 2h9l5 5v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z"/>
        </svg> Inscripciones
            <h2 style="font-size:24px;">{{ $inscripciones }}</h2>
        </div>

        <div style="background: linear-gradient(135deg, #ef4444, #b91c1c); color:white; padding:20px; border-radius:12px; box-shadow:0 10px 20px rgba(0,0,0,0.05);">
            <svg style="width:40px;height:40px;" fill="white" viewBox="0 0 24 24">
            <path d="M12 2l3 7h7l-5.5 4.1L18 21l-6-4-6 4 1.5-7.9L2 9h7z"/>
        </svg> Certificados
            <h2 style="font-size:24px;">{{ $certificados }}</h2>
        </div>

    </div>

   <!-- 📊 DASHBOARD WRAPPER -->
<div style="
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
    margin-top: 40px;
">

    <!-- 📈 IZQUIERDA: GRÁFICA LINEAL -->
     
    <div style="
        background: white;
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    ">
<form
    action="{{ route('admin.dashboard.exportar') }}"
    method="GET"
    style="display:flex; gap:10px; align-items:center;">

    <label>
        Año:
    </label>

    <select
        name="anio"
        style="
            padding:8px 12px;
            border:1px solid #d1d5db;
            border-radius:8px;
        ">

        @for($i = date('Y'); $i >=2026; $i--)

            <option value="{{ $i }}">
                {{ $i }}
            </option>

        @endfor

    </select>

    <button
        type="submit"
        style="
            background:#16a34a;
            color:white;
            border:none;
            padding:10px 18px;
            border-radius:8px;
            cursor:pointer;
            font-weight:bold;
        ">

        <i class="fa-solid fa-file-excel"></i>
    Exportar Excel

    </button>

</form>
        <h2 style="margin-bottom:15px; font-size:18px; font-weight:600;">
            📈 Inscripciones por mes
        </h2>

        <canvas id="graficaInscripciones"></canvas>

    </div>

    <!-- 📊 DERECHA: GRÁFICA CIRCULAR -->
    <div style="background: white;padding: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.08);">
        <form
    method="GET"
    action="{{ route('admin.dashboard.exportar.inscripciones.cursos') }}"
    style="margin-top:15px;display:flex;justify-content:flex-end;">

    <button
        type="submit"
        style="
            background:#16a34a;
            color:white;
            border:none;
            padding:10px 18px;
            border-radius:10px;
            cursor:pointer;
            font-weight:600;
            display:flex;
            align-items:center;
            gap:8px;
            box-shadow:0 4px 10px rgba(22,163,74,.25);
        ">

        <i class="fa-solid fa-file-excel"></i>
        Exportar cursos e inscripciones

    </button>

</form>
        <h2 style="margin-bottom:15px; font-size:18px; font-weight:600;">
            📊 Cursos
        </h2>

        <canvas id="graficaUsuarios"></canvas>

    </div>

</div>

</div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('graficaInscripciones');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],

        datasets: [{
            label: 'Inscripciones',
             data: @json($inscripcionesPorMes),
            backgroundColor: '#2563eb'
        }]
    },

    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});


const ctx2 = document.getElementById('graficaUsuarios');

new Chart(ctx2, {

    type: 'doughnut',

    data: {

        labels: @json($nombresCursos),

        datasets: [{

            data: @json($cantidadCursos),

            backgroundColor: [
                '#1041a8',
                '#16a34a',
                '#f59e0b',
                '#dc2626',
                '#9333ea',
                '#2ac3e9'
            ],

            borderWidth:2

        }]

    },

    options: {

        cutout:'65%',

        plugins: {
    legend: {
        position: 'top',
        align: 'center',
        labels: {
            boxWidth: 14,
            boxHeight: 14,
            padding: 18,
            font: {
                size: 13,
                weight: 'bold'
            },
            color: '#374151'
        }
    }
}

    }

});
</script>
