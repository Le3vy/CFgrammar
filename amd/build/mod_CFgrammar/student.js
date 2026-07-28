define('mod_cfgrammar/student', [], function() {

    function init(cmid) {
        const btn = document.getElementById('generate-word-btn');
        const output = document.getElementById('generated-word');

        if (!btn || !output) {
            return;
        }

        btn.addEventListener('click', () => {
            const url = M.cfg.wwwroot + '/mod/cfgrammar/generate.php?id=' + cmid;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    output.innerHTML = data.word || 'No word generated.';
                })
                .catch(() => {
                    output.innerHTML = 'Error generating word.';
                });
        });
    }

    return { init: init };
});
