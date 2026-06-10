define('mod_cfgrammar/grammar', [], function() {
    function init() {
        const container = document.getElementById('grammar-rules-container');
        const template = document.getElementById('grammar-rule-template');
        const addBtn = document.getElementById('add-rule-btn');

        if (!container || !template || !addBtn) {
            console.error('Grammar UI elements missing.');
            return;
        }

        function addRuleRow(lhs = '', rhs = '') {
            const clone = template.content.cloneNode(true);
            const row = clone.querySelector('.grammar-rule-row');
            const lhsInput = row.querySelector('input[name="lhs[]"]');
            const rhsInput = row.querySelector('input[name="rhs[]"]');
            lhsInput.value = lhs;
            rhsInput.value = rhs;
            row.querySelector('.delete-rule-btn').addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                row.remove();
            });
            container.appendChild(row);
        }

        addRuleRow();
        addBtn.addEventListener('click', () => addRuleRow());
    }

    return { init: init };
});
