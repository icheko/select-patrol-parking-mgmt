FROM gitpod/workspace-full

RUN wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb

# Install custom tools, runtime, etc.
RUN sudo apt-get update \
    && sudo apt-get install -y \
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

RUN sudo dpkg -i google-chrome-stable_current_amd64.deb
