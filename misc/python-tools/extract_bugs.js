() => {
    const rows = document.querySelectorAll('tr.cursor-pointer');
    return Array.from(rows).map(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length < 6) return null;

        const linkEl    = cells[0].querySelector('a');
        const bugId     = linkEl ? linkEl.innerText.trim() : '';
        const href      = linkEl ? linkEl.getAttribute('href') : '';
        const detailUrl = href
            ? (href.startsWith('http') ? href : 'https://boardgamearena.com' + href)
            : '';

        const statusEl   = cells[1].querySelector('span');
        const statusText = statusEl ? statusEl.innerText.trim() : 'open';

        const votes    = cells[2].innerText.trim().split('\n')[0].trim();
        const game     = cells[3].innerText.trim();
        const category = cells[4].innerText.trim();
        const title    = cells[5].innerText.trim();

        const dateEl = cells[6] ? cells[6].querySelector('span') : null;
        const date   = dateEl ? dateEl.innerText.trim() : '';

        return { bugId, detailUrl, statusText, votes, game, category, title, date };
    }).filter(Boolean);
}
