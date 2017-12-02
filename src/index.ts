import { Handler } from "aws-lambda";
import { execFile } from "child_process";

const LIB = process.env.LAMBDA_TASK_ROOT + "/lib";
const PHP = LIB + "/php-cgi";
//const PHP = "/usr/bin/php-cgi";

export const handler: Handler = function(event, context, callback) {
  const request = event.Records[0].cf.request;
  const args = [
    "wp-admin/install.php"
  ];
  const opts = {
    env: {
      // PHP runtime environment
      PHP_INI_SCAN_DIR: LIB + ":" + LIB + "/php-7.1.d",
      //PHP_INI_SCAN_DIR: LIB + ":" + "/etc/php/7.0/cli/conf.d",
      // WordPress $_SERVER[] environment
      DOCUMENT_ROOT: process.env.LAMBDA_TASK_ROOT,
      HTTP_CLIENT_IP: request.clientIp,
      HTTP_HOST: request.headers.host[0].value,
      REDIRECT_STATUS: 302,
      REQUEST_METHOD: request.method,
      REQUEST_URI: request.uri,
      SCRIPT_FILENAME: process.env.LAMBDA_TASK_ROOT + "/wp-admin/install.php",
      SERVER_NAME: request.headers.host[0].value,
      SERVER_PORT: 443,
      SERVER_PROTOCOL: "HTTPS",
      // Everything else
      ...process.env
    }
  };
  execFile(PHP, args, opts, (error, stdout, stderr) => {
    if (error) {
      console.log(stderr);
      throw error;
    }
    console.log(stdout);
    callback && callback();
  });
}

/*
handler({
  Records: [
    {
      cf: {
        request: {
          headers: {
            "host": [
              {
                "value": "bethesignal.org"
              }
            ]
          },
          uri: "/wp-admin/install.php",
          method: "GET",
          clientIp: "127.0.0.1"
        }
      }
    }
  ]
}, {
  callbackWaitsForEmptyEventLoop: false,
  functionName: "pantalones",
  functionVersion: "2",
  invokedFunctionArn: "",
  memoryLimitInMB: 128,
  awsRequestId: "",
  logGroupName: "",
  logStreamName: "",
  getRemainingTimeInMillis: (): number => { return 0; },
  done: () => {},
  fail: () => {},
  succeed: () => {},
});
*/
