args <- commandArgs(TRUE)

data_source <- args[1]
param_input <- args[2]
param_output <- args[3]
data_source_uri <- paste("../upload/", data_source, sep="")

library(epicalc)
library(plyr)

df <- read.csv(data_source_uri,  header = TRUE, na.strings=NA)
use(df)

x <- tab1(param_input)
write.csv(x$table, param_output)
dev.off()
