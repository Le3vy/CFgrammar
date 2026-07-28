define('mod_cfgrammar/grammar', [], function() {

    function init(cfgrammarid) {
        const container = document.getElementById('grammar-rules-container');
        const template = document.getElementById('grammar-rule-template');

        if (!container || !template) {
            console.error('Grammar UI elements missing.');
            return;
        }

        function addRuleRow(lhs = '', rhs = '') {
            const clone = template.content.cloneNode(true);
            const row = clone.querySelector('.grammar-rule-row');
            container.appendChild(row);
        }

        // Fetch rule count from PHP
        const url = M.cfg.wwwroot + '/mod/cfgrammar/getrulecount.php?cfgrammarid=' + cfgrammarid;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const count = data.rulecount || 0;

                for (let i = 0; i < count; i++) {
                    addRuleRow();
                }
            })
            .catch(err => {
                console.error('Could not load rule count', err);
            });
    }

    return { init: init };
});
