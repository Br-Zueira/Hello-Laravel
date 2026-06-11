async function getExcuse() {
    try {
        const response = await fetch("/excuse");
        const json = await response.json();
        return json;
    } catch (error) {
        console.error("getExcuse - Network error:", error);
        return null;
    }
}

async function showExcuse() {
    const categoryP = document.getElementById("category");
    const riskP = document.getElementById("risk");
    const excuseP = document.getElementById("excuse");
    const severityScoreP = document.getElementById("severity_score");
    const believabilityRateP = document.getElementById("believability_rate");
    const chaosScoreP = document.getElementById("chaos_score");
    const reloadExcuseBtn = document.getElementById("reloadExcuse");

    if (!categoryP || !riskP || !excuseP || !reloadExcuseBtn || !severityScoreP || !believabilityRateP || !chaosScoreP) {
        return;
    }

    excuseP.innerText = "Loading...";

    const excuse = await getExcuse();

    if (!excuse) {
        categoryP.innerText = "Error";
        riskP.innerText = "No excuses found";
        excuseP.innerText = "It was not my fault, I swear!";
        severityScoreP.innerText = "Severity score: infinity";
        believabilityRateP.innerText = "Believability Rate: -1000%";
        chaosScoreP.innerText = "Chaos Score: NaN";

        reloadExcuseBtn.innerText = "Try again";
        return;
    }

    categoryP.innerText = `Category: ${excuse.category}`;
    riskP.innerText = `Risk: ${excuse.risk}`;
    excuseP.innerText = `${excuse.excuse}`;
    severityScoreP.innerText = `Severity score: ${excuse.severity_score}`;
    believabilityRateP.innerText = `Believability Rate: ${excuse.believability_rate}`;
    chaosScoreP.innerText = `Chaos Score: ${excuse.chaos_score}`;

    reloadExcuseBtn.innerText = "Get another excuse";
}

function initCopyExcuse () {
    const copyExcuseBtn = document.getElementById("copyExcuse");
    if (copyExcuseBtn) {
        copyExcuseBtn.addEventListener('click', async () => {
            const excuse = document.getElementById("excuse");
            if (excuse) {
                await navigator.clipboard.writeText(excuse.innerText);
            }
        })
    }
}

export function initExcuse() {
    showExcuse();
    initCopyExcuse();
    
    const reloadExcuseBtn = document.getElementById("reloadExcuse");
    if (reloadExcuseBtn) {
        reloadExcuseBtn.addEventListener('click', showExcuse);
    }
}