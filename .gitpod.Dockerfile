FROM gitpod/workspace-full

# Install custom tools, runtime, etc.
RUN sudo apt-get update \
    && sudo apt-get install -y \
        libnss3-dev \
    && rm -rf /var/lib/apt/lists/*