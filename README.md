# neptune-php

proto生成php文件
```
cd proto
protoc --proto_path=./ --php_out=../grpc/ --grpc_out=../grpc/ --plugin=protoc-gen-grpc=/webser/grpc/bins/opt/grpc_php_plugin  redis.proto
```