PipelineCollection with PHP Traits
==================================

I was heavily refactoring one big legacy project for last few months, thus I was seeking valuable information on
working with Legacy Code and Refactoring particularly. Being a reader of Martin Fowler's bliki, I recently read
very interesting article on refactoring loops into more readable code:

[Refactoring with Loops and Collection Pipelines](http://martinfowler.com/articles/refactoring-pipelines.html)

One of my favorite principles in coding is "Software code should read like well-written prose", so I just could not
pass by. I've adopted this idea to be used with PHP, using one of it's underestimated feature, Traits.

The idea is simple, you have a trait, called PipelineCollection, that allows you to add map, filter and reduce
functionality to your existing classes, and you have class PipelineList, that allows you to wrap any array and
chain filter, map and reduce methods.

Those class and trait can be easily extended to your needs.

Note for those, who worry about performance. This approach indeed can lead to increased memory consumption, etc.
Modern approach to optimization is to do it only when you really need. This means, that you should care about
optimization only when your code already works, and you profile it to find bottlenecks. In most cases they won't be
related to such classes.
