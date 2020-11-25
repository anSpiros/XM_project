FROM node:lts

# set working directory
WORKDIR /src

COPY package*.json ./

RUN npm install
RUN npm install react-scripts -g

EXPOSE 3000

CMD ["npm", "start"]
