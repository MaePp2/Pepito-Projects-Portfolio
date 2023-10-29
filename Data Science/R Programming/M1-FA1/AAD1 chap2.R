# ========================================================================================================
# Purpose:      Rscript in AAD1 Chap 2
# Author:       Chew C.H.
# DOC:          10 Sep 2014
# Topics:       Train-test split
# Packages:     caTools
# Data:         german_credit.csv
#=========================================================================================================

library(caTools)

setwd("C:\\Users\\jpqtomas\\OneDrive - Mapúa University\Desktop\Artificial Intelligence, Analytics and Data Science (Vol. 1), 1st Edition")
data1 <- read.csv("C:\\Users\\jpqtomas\\OneDrive - Mapúa University\\Desktop\\Artificial Intelligence, Analytics and Data Science (Vol. 1), 1st Edition\\Chapter 2\\9814896721_651921\\Chapter 2\\german_credit.csv")

data1$Creditability <- factor(data1$Creditability)  # Convert Creditability to categorical variable
summary(data1$Creditability)  # Shows the distribution of values in the specified variable

prop.table(table(data1$Creditability))  # Shows the proportion of values in the specified variable.

# set the random number sequence for random split.
# Reproducible in future with the same number that you choose.
set.seed(2014)

# Stratify on Y and randomly split data into train vs test set based on Split ratio
train <- sample.split(Y = data1$Creditability, SplitRatio = 0.7)

# Get training and test data
trainset <- subset(data1, train == T)
testset <- subset(data1, train == F)

# Check that the proportion of Y is the same in Trainset and Testset
prop.table(table(trainset$Creditability))

prop.table(table(testset$Creditability))

# ========== END ===============================================================

