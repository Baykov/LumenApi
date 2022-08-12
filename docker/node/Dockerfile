FROM node:10.24

RUN npm install --global gulp gulp-cli gulp-util --save-dev

WORKDIR /app
USER node
CMD [ "/bin/bash", "/app/bin/run_frontend.sh" ]
