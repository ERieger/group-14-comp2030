function activateTask(job) {
    sessionStorage.setItem("job", job);
    window.location.href = '/factory-dashboard/src/dashboard.php';
}