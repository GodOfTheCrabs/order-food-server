import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '0fcc21a03332921ccc22',
    cluster: 'eu',
    forceTLS: true,
});

window.Echo.channel('reports')
    .listen('ReportGenerated', (event) => {
        console.log('Report Generated:', event.pdfPath);
        alert('Report generated successfully. Download link: ' + event.pdfPath);
    });