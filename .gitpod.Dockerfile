FROM gitpod/workspace-full

RUN wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb

# Install chrome/chrome-driver requirements
RUN sudo apt-get update \
    && sudo apt-get install -y \
        gdebi-core \
        fonts-liberation \
        libappindicator3-1 \
        libdrm2 \
        libgbm1 \
        libx11-xcb1 \
        libxcb-dri3-0 \
        libxss1 \
        xdg-utils \
        libnss3-dev \
    && sudo rm -rf /var/lib/apt/lists/*

RUN sudo gdebi google-chrome-stable_current_amd64.deb
