<div class="celebration-container">
    <i class="fas fa-star icon" style="top: -15px; left: -15px; color: gold; font-size: 30px;"></i>
    <i class="fas fa-birthday-cake icon" style="top: -20px; right: -20px; color: #ff5722; font-size: 40px;"></i>
    <i class="fas fa-gift icon" style="bottom: -25px; left: -25px; color: #4caf50; font-size: 35px;"></i>
    <i class="fas fa-glass-cheers icon" style="bottom: -20px; right: -15px; color: #2196f3; font-size: 30px;"></i>
    <i class="fas fa-music icon" style="top: 10px; left: -40px; color: #9c27b0;"></i>
    <i class="fas fa-music icon" style="top: 10px; right: -40px; color: #9c27b0;"></i>

    <p class="celebration-message">
        Congratulations! 🎉<br>
        You Did It! 🥳<br>
        Let's Celebrate! 🎊
    </p>

    <i class="fas fa-heart icon" style="bottom: -30px; left: 50%; color: #e91e63; font-size: 25px;"></i>
    <i class="fas fa-confetti icon" style="top: -30px; left: 50%; color: #00bcd4; font-size: 25px;"></i>
</div>
<style>
    .celebration-container {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #ffeb3b;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0,0,0,0.3);
        text-align: center;
        z-index: 1000;
        border: 3px dashed #ff5722;
        animation: pulse 1.5s infinite;
    }

    .celebration-message {
        font-size: 32px;
        font-weight: bold;
        color: #e91e63;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }

    .icon {
        position: absolute;
        font-size: 24px;
        animation: float 3s infinite ease-in-out;
    }

    @keyframes pulse {
        0% { transform: translate(-50%, -50%) scale(1); }
        50% { transform: translate(-50%, -50%) scale(1.05); }
        100% { transform: translate(-50%, -50%) scale(1); }
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
</style>
