
<script>

function openIndexModal(eventData) {
    if (!eventData) {
        console.warn('openIndexModal: no event data provided');
        return;
    }

    const modal = document.getElementById('indexEventModal');
    const content = document.getElementById('eventModalContent');
    if (!modal || !content) return;

    // Build dynamic HTML
    content.innerHTML = buildEventModalHTML(eventData);

    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeEventModal() {
    const modal = document.getElementById('indexEventModal');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

/**
 * Escape HTML to prevent XSS.
 */
function escHtml(str) {
    if (str == null) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

/**
 * Format date from ISO string.
 */
function formatEventDate(isoDate) {
    if (!isoDate) return 'TBA';
    try {
        const d = new Date(isoDate);
        const day   = d.getDate();
        const month = d.toLocaleString('en-GB', { month: 'long' });
        const year  = d.getFullYear();
        return `${day} ${month} ${year}`;
    } catch (e) {
        return isoDate;
    }
}

/**
 * Build full modal HTML from event data.
 */
function buildEventModalHTML(e) {
    const heroImage = e.hero_image_url || e.hero_image || "<?php echo e(asset('img/event2.png')); ?>";
    const logoUrl   = "<?php echo e(asset('img/logo.png')); ?>";
    const appName   = "<?php echo e(config('app.name')); ?>";

    const categories   = Array.isArray(e.categories)   ? e.categories   : [];
    const entitlements = Array.isArray(e.entitlements) ? e.entitlements : [];
    const awards       = (e.awards && typeof e.awards === 'object') ? e.awards : {};
    const schedules    = Array.isArray(e.schedules)    ? e.schedules    : [];
    const rules        = Array.isArray(e.rules)        ? e.rules        : [];

    /* ============ HERO ============ */
    const heroHtml = `
        <section class="event-hero">
            <div class="hero-content">
                <div class="brand">
                    <img src="${logoUrl}" alt="" style="height: 70px;">
                </div>
                <div class="event-label">EVENT DETAILS</div>
                ${e.presented_by ? `<div class="presented">${escHtml(e.presented_by)}</div>` : ''}
                <div style="display: flex; align-items: center; flex-wrap: nowrap; gap: 10px;">
                    <div class="hero-title">${escHtml(e.title || '')}</div>
                </div>
                ${e.subtitle ? `<p style="margin-top: 10px; opacity: 0.9; font-size: 15px;">${escHtml(e.subtitle)}</p>` : ''}
            </div>
            <div class="runners">
                <img src="${heroImage}" alt="${escHtml(e.title || '')}">
            </div>
        </section>`;

    /* ============ DESCRIPTION ============ */
    const descriptionHtml = e.description
    ? e.description
    : '<p>Event details coming soon.</p>';

    /* ============ OVERVIEW ============ */
    const catList = categories.map(c => c.distance).filter(Boolean).join(' • ') || '—';

    const overviewHtml = `
        <div class="overview">
            <div class="overview-list mobile-overview-grid"
                 style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px 20px;">
                <div class="overview-item" style="display: flex; align-items: center; gap: 8px;">
                    <span class="icon">🏃</span>
                    <b style="min-width: 70px;">Event</b>
                    <span>:</span>
                    <span>${escHtml(e.title || '—')}</span>
                </div>
                <div class="overview-item" style="display: flex; align-items: center; gap: 8px;">
                    <span class="icon">🏆</span>
                    <b style="min-width: 70px;">Category</b>
                    <span>:</span>
                    <span>${escHtml(catList)}</span>
                </div>
                <div class="overview-item" style="display: flex; align-items: center; gap: 8px;">
                    <span class="icon">📅</span>
                    <b style="min-width: 70px;">Date</b>
                    <span>:</span>
                    <span>${formatEventDate(e.event_date)}</span>
                </div>
                <div class="overview-item" style="display: flex; align-items: center; gap: 8px;">
                    <span class="icon">📍</span>
                    <b style="min-width: 70px;">Location</b>
                    <span>:</span>
                    <span>${escHtml(e.location || 'TBA')}</span>
                </div>
                <div class="overview-item" style="display: flex; align-items: center; gap: 8px;">
                    <span class="icon">🏁</span>
                    <b style="min-width: 70px;">Type</b>
                    <span>:</span>
                    <span>${escHtml(e.race_type || 'Live Road Race')}</span>
                </div>
                <div class="overview-item" style="display: flex; align-items: center; gap: 8px;">
                    <span class="icon">👥</span>
                    <b style="min-width: 70px;">Organizer</b>
                    <span>:</span>
                    <span>${escHtml(e.organizer || appName)}</span>
                </div>
            </div>
        </div>`;

    /* ============ CATEGORIES ============ */
    let categoriesHtml = '';
    if (categories.length > 0) {
        const cards = categories.map(cat => {
            const distance = escHtml(cat.distance || '');
            const name     = escHtml(cat.name || '');
            const tagline  = escHtml(cat.tagline || '');
            const desc     = escHtml(cat.description || '');
            const cutoff   = escHtml(cat.cutoff || '');
            const fee      = cat.fee ? Number(cat.fee).toLocaleString() : '';

            return `
                <div class="race-card" style="display: flex; flex-direction: column;">
                    <div class="race-header">
                        <div>
                            <div class="race-distance">${distance}</div>
                            <div class="race-name">${name}</div>
                        </div>
                        <div class="race-runner-icon">🏃</div>
                    </div>
                    <div class="race-body" style="display: flex; flex-direction: column; flex-grow: 1;">
                        ${tagline ? `<h4>${tagline}</h4>` : ''}
                        ${desc ? `<p>${desc}</p>` : ''}
                        ${cutoff ? `<div class="cutoff" style="margin-top: auto;">Cut-Off Time: <strong>${cutoff}</strong></div>` : ''}
                        ${fee ? `<div class="cutoff" style="margin-top: 6px;">Entry Fee: <strong>BDT ${fee}</strong></div>` : ''}
                    </div>
                </div>`;
        }).join('');

        categoriesHtml = `
            <section class="race-section">
                <div class="section-title">
                    <span class="section-icon">🏃</span> RACE CATEGORIES
                </div>
                <div class="race-grid mobile-race-grid"
                     style="display: grid; grid-template-columns: repeat(${Math.min(categories.length, 3)}, 1fr); gap: 20px;">
                    ${cards}
                </div>
            </section>`;
    }

    /* ============ ENTITLEMENTS ============ */
    let entitlementsHtml = '';
    if (entitlements.length > 0) {
        const items = entitlements.map(ent => `
            <div class="entitlement">
                <div class="entitlement-icon">${escHtml(ent.icon || '🎁')}</div>
                ${escHtml(ent.text || '').replace(/\n/g, '<br>')}
            </div>`).join('');

        entitlementsHtml = `
            <div class="panel">
                <div class="section-title">
                    <span class="section-icon">🎁</span> RUNNER ENTITLEMENTS
                </div>
                <div class="entitlement-grid" style="grid-template-columns: repeat(4, 1fr);">
                    ${items}
                </div>
            </div>`;
    }

    /* ============ AWARDS ============ */
    let awardsHtml = '';
    const awardPositions = (awards.positions && Array.isArray(awards.positions)) ? awards.positions : [];

    if (awardPositions.length > 0 && categories.length > 0) {
        const headerCols = categories.map(cat =>
            `<th>${escHtml(cat.name || '')}${cat.distance ? ' (' + escHtml(cat.distance) + ')' : ''}</th>`
        ).join('');

        const bodyRows = awardPositions.map(pos => {
            const amounts = Array.isArray(pos.amounts) ? pos.amounts : [];
            const cells = categories.map((cat, i) => {
                const amt = amounts[i];
                return `<td>${amt ? `<strong>${escHtml(amt)}</strong> BDT` : '—'}</td>`;
            }).join('');

            return `
                <tr style="font-size: 14px;">
                    <td><strong>${escHtml(pos.label || '')}</strong></td>
                    ${cells}
                </tr>`;
        }).join('');

        awardsHtml = `
            <div class="panel">
                <div class="section-title">
                    <span class="section-icon">🏆</span> AWARDS AND RECOGNITION
                </div>
                ${awards.intro ? `<div class="award-intro">${escHtml(awards.intro).replace(/\n/g, '<br>')}</div>` : ''}
                <table class="award-table">
                    <thead>
                        <tr style="font-size: 14px;">
                            <th>POSITION</th>
                            ${headerCols}
                        </tr>
                    </thead>
                    <tbody>
                        ${bodyRows}
                    </tbody>
                </table>
                ${awards.notes ? `<div class="notes"><strong>Important Notes:</strong><br>• ${escHtml(awards.notes)}</div>` : ''}
            </div>`;
    }

    /* ============ LOWER SECTION ============ */
    const lowerHtml = (entitlementsHtml || awardsHtml)
        ? `<div class="lower-grid">${entitlementsHtml}${awardsHtml}</div>`
        : '';

    /* ============ SCHEDULES ============ */
    let scheduleHtml = '';
    if (schedules.length > 0) {
        const items = schedules.map(sch => `
            <div style="display: flex; align-items: center; gap: 12px; padding: 8px 0; border-bottom: 1px dashed #e2e8f0;">
                <strong style="min-width: 90px; color: #e11d48;">${escHtml(sch.time || '')}</strong>
                <span style="flex: 1;">${escHtml(sch.title || '')}</span>
                ${sch.note ? `<span style="font-size: 12px; opacity: 0.7;">${escHtml(sch.note)}</span>` : ''}
            </div>`).join('');

        scheduleHtml = `<div>${items}</div>`;
    } else {
        scheduleHtml = `<div class="tba">🕐 TBA</div>`;
    }

    /* ============ RULES ============ */
    let rulesHtml = '';
    if (rules.length > 0) {
        const items = rules.map(rule => `<li>${escHtml(rule)}</li>`).join('');
        rulesHtml = `<ul>${items}</ul>`;
    } else {
        rulesHtml = `<p style="opacity: 0.7;">Rules will be published soon.</p>`;
    }

    /* ============ FINAL COMPOSITION ============ */
    return `
        ${heroHtml}
        <div class="event-content">
            <div class="intro-grid">
                <div class="intro-text">
                    ${descriptionHtml}
                </div>
                <div>
                    <div class="section-title">
                        <span class="section-icon">📅</span> EVENT OVERVIEW
                    </div>
                    ${overviewHtml}
                </div>
            </div>

            ${categoriesHtml}
            ${lowerHtml}

            <div class="bottom-grid">
                <div class="schedule">
                    <div class="section-title">
                        <span class="section-icon">📅</span> RACE DAY SCHEDULE
                    </div>
                    ${scheduleHtml}
                </div>

                <div class="rules">
                    <div class="section-title">
                        <span class="section-icon">📋</span> RULES AND GUIDELINES
                    </div>
                    ${rulesHtml}
                </div>
            </div>

            <div class="event-footer">
                <div class="footer-main">
                    More Than a Race, <span>It's a Movement.</span>
                </div>
                <div class="footer-brand">${appName.toUpperCase()}</div>
                <div class="footer-small">MORE THAN A RACE • A COMMUNITY</div>
            </div>
        </div>`;
}
</script>
<?php /**PATH C:\laragon\www\run-event\resources\views/event-details-js.blade.php ENDPATH**/ ?>